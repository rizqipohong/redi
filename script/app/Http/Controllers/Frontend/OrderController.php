<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Customer;
use App\Models\Userorder;
use App\Order;
use App\Orderitem;
use App\Useroption;
use App\Ordermeta;
use App\Ordershipping;
use App\Category;
use App\Trasection;
use Cart;
use Hash;
use Illuminate\Support\Facades\Crypt;
use Session;
use App\Mail\SellerOrderMail;
use Illuminate\Support\Facades\Mail;
use App\Helper\Order\Paypal;
use App\Helper\Order\Instamojo;
use App\Helper\Order\Toyyibpay;
use App\Helper\Order\Stripe;
use App\Helper\Order\Mollie;
use App\Helper\Order\Paystack;
use App\Helper\Order\Mercado;
use App\Helper\Order\Ratapay;
use Cache;
use App\Models\Userplanmeta;
use Str;
use DB;
use URL;

class OrderController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Cart::count() == 0) {
            return back();
        }

        $validated = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:100',
            'phone' => 'required|max:20',
        ]);
        $shop_type = domain_info('shop_type');
        $domain_id = domain_info('domain_id');
        $user_id = domain_info('user_id');
        if ($shop_type == 1) {
            $validated = $request->validate([
//                'shipping_mode' => 'required',
//                'delivery_address' => 'required|max:100',
//                'zip_code' => 'required|max:50',
                //                'location' => 'required',
            ]);
        }

        if ($request->create_account == 1) {
            $validated = $request->validate([
                'email' => 'required|email|max:100',
                'password' => 'required|min:8',
            ]);
            $check_is_exist = Customer::where('email', $request->email)->where('created_by', domain_info('user_id'))->first();
            if (!empty($check_is_exist)) {
                Session::flash('user_limit', 'Opps email address already exists');

                return back();
            }
            $plan = Userplanmeta::where('user_id', $user_id)->first();
            $user_limit = $plan->customer_limit ?? 0;
            $total_customers = Customer::where('created_by', $user_id)->count();

//            if ($user_limit <= $total_customers) {
//                Session::flash('user_limit', 'Opps something wrong with registration but you can make order');
//                Session::put('registration', false);
//                return back();
//            } else {
//                Session::forget('registration');
//            }
            $user = new Customer();
            $user->email = $request->email;
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->domain_id = $domain_id;
            $user->created_by = $user_id;
            $user->save();
            Auth::guard('customer')->loginUsingId($user->id);
        } else {
            $check = DB::table('guests')->where('email', $request->email)->first();
            if ($check) {
                $guest_id = $check->id;
            } else {
                DB::table('guests')
                    ->insert([
                        'name' => $request->name,
                        'email' => $request->email,
                        'url' => URL::to('/guest/dashboard' , Crypt::encryptString($request->email)),
                        'domain_id' => $domain_id,
                        'created_by' => $user_id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                $guest_id = DB::getPdo()->lastInsertId();
            }
        }

        $prefix = Useroption::where('user_id', $user_id)->where('key', 'order_prefix')->first();
        $max_id = Order::max('id');
        if (empty($prefix)) {
            $prefix = $max_id + 1;
        } else {
            $prefix = $prefix->value . $max_id;
        }

        $shipping_amount = Category::where('user_id', $user_id)->where('type', 'method')->find($request->shipping_mode);
        if ($request->payment_method == 2) {
            $payment_id = Str::random(10);
        } else {
            $payment_id = null;
        }

        DB::beginTransaction();
        try {


            $order = new Order;
            $order->order_no = $prefix;
            if (Auth::guard('customer')->check()) {
                $order->customer_id = Auth::guard('customer')->user()->id;
            }else{
                $order->guest_id = $guest_id;
            }

            $shipment = $request->shipment;
            $order->user_id = $user_id;
            $order->order_type = $shop_type;
            $order->payment_status = 2;
            $order->status = 'pending';
            $order->transaction_id = $payment_id;
            $order->category_id = $request->payment_method;
            $order->payment_status = 2;
            $order->tax = Cart::tax();
            $order->shipping = 'none';
            $order->total = ($this->calculateShipping(Cart::total(), $shipping_amount->slug ?? 0, Cart::weight())) + $shipment;
            $order->save();

            $info['name'] = $request->name;
            $info['email'] = $request->email;
            $info['phone'] = $request->phone;
            $info['comment'] = $request->comment;
            $info['address'] = $request->delivery_address;
            $info['zip_code'] = $request->zip_code;
            $info['province'] = $request->province;
            $info['city'] = $request->city;
            $info['disctrict'] = $request->location;
            $info['service'] = $request->service;
            $info['estimation'] = $request->estimation;
            $info['dropshipper'] = $request->name_dropship;
            $info['dropshipper_phone'] = $request->number_hp;
            $info['coupon_discount'] = Cart::discount();
            $info['sub_total'] = Cart::subtotal();

            $meta = new Ordermeta;
            $meta->order_id = $order->id;
            $meta->key = 'content';
            $meta->value = json_encode($info);
            $meta->save();

            $items = [];

//            save url notification
            DB::table('ordernotif')->insert([
                'order_id' => $order->id,
                'url' => URL::to('/seller/order', $order->id),
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            foreach (Cart::content() as $key => $row) {
                $options['attribute'] = $row->options->attribute;
                $options['options'] = $row->options->options;
                $data['order_id'] = $order->id;
                $data['term_id'] = $row->id;
                $data['info'] = json_encode($options);
                $data['qty'] = $row->qty;
                $data['amount'] = $row->price;
                array_push($items, $data);
            }

            Orderitem::insert($items);
//       affiliate sistem
            if ($request->affiliate) {
                $user = DB::table('customers')->where('name', $request->affiliate)->first();
                $product = DB::table('prices')->where('term_id', $request->product_aff)->first();
                $domain = DB::table('domains')->where('user_id', $request->seller_id)->first();
                $total_com = ($product->affiliate / 100) * $product->price;
                DB::table('affiliate')->insert([
                    'term_id' => $request->product_aff,
                    'domain_id' => $domain->id,
                    'user_id' => $user->id,
                    'total_commisiion_values' => $total_com,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
//                aff_ratapay
                $aff_ratapay['email'] = $user->email;
                $aff_ratapay['share_amount'] = $total_com;
                Session::put('customer_aff_info', $aff_ratapay);
            }

            if ($request->location) {
                $ship['order_id'] = $order->id;
                $ship['location_id'] = 96;
                $ship['shipping_id'] = 96;
                Ordershipping::insert($ship);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        Session::put('order_no', $order->order_no);
        if ($request->payment_method != 2) {
            $payment_data['ref_id'] = $order->id;
            $payment_data['getway_id'] = $request->payment_method;
            $payment_data['amount'] = $order->total;
            $payment_data['refund_threshold'] = $order->max_etd($info['estimation']) + 3 ;
            $payment_data['email'] = $request->email;
            $payment_data['name'] = $request->name;
            $payment_data['phone'] = $request->phone;
            $payment_data['shipping'] = 43;
            $payment_data['billName'] = 'Order No :' . $order->order_no;
            $item_detail = [];

            foreach (Cart::content() as $key => $row) {
                $item_getDB = DB::table('terms')->where('id', $row->id)->first();
                $items_data['order_id'] = $order->id;
                $items_data['term_id'] = $row->id;
                $items_data['product'] = $row->name;
                $items_data['type'] = $item_getDB->type;
                $items_data['category'] = $item_getDB->slug;
                $items_data['info'] = json_encode($options);
                $items_data['qty'] = $row->qty;
                $items_data['amount'] = $row->price;
                array_push($item_detail, $items_data);
            }
            Session::put('customer_order_info', $payment_data);
            Session::put('customer_items_info', $item_detail);

            if ($request->payment_method == 5) {
                try {
                    return Paypal::make_payment($payment_data);
                } catch (Exception $e) {
                    Order::destroy($order->id);
                    return $this->payment_fail();
                }

            }
            if ($request->payment_method == 94) {
                try {
//              dd($item_detail);
                    return Ratapay::make_payment($payment_data);
                } catch (Exception $e) {
                    Order::destroy($order->id);
                    return $this->payment_fail();
                }

            }
            if ($request->payment_method == 3) {
                try {
                    return Instamojo::make_payment($payment_data);
                } catch (Exception $e) {
                    Order::destroy($order->id);
                    return $this->payment_fail();
                }
            }
            if ($request->payment_method == 7) {
                try {
                    return Toyyibpay::make_payment($payment_data);
                } catch (Exception $e) {
                    Order::destroy($order->id);
                    return $this->payment_fail();
                }
            }
            if ($request->payment_method == 8) {
                try {
                    return Mollie::make_payment($payment_data);
                } catch (Exception $e) {
                    Order::destroy($order->id);
                    return $this->payment_fail();
                }

            }
            if ($request->payment_method == 6) {
                Session::put('stripe_payment', true);
                return redirect('/payment-with-stripe');
            }
            if ($request->payment_method == 4) {
                Session::put('razorpay_payment', true);
                return redirect('/payment-with-razorpay');
            }
            if ($request->payment_method == 9) {
                Session::put('paystack_payment', true);
                return redirect('/payment-with-paystack');
            }
            if ($request->payment_method == 10) {
                try {
                    return Mercado::make_payment($payment_data);
                } catch (Exception $e) {
                    Order::destroy($order->id);
                    return $this->payment_fail();
                }
            }

        }


        try {
            if (Cache::has(domain_info('user_id') . 'store_email')) {
                $store_email = Cache::get(domain_info('user_id') . 'store_email');
            } else {

                $admin = User::findorFail($user_id);
                $store_email = $admin->email;
            }

            $mail_data['store_email'] = $store_email;
            $mail_data['order_no'] = $prefix;
            $mail_data['base_url'] = url('/');
            $mail_data['site_name'] = Cache::get(domain_info('user_id') . 'shop_name', env('APP_NAME'));
            $mail_data['order_url'] = url('/seller/order', $order->id);

            if (env('QUEUE_MAIL') == 'on') {

                dispatch(new \App\Jobs\Ordernotification($mail_data));
            } else {

                Mail::to($store_email)->send(new SellerOrderMail($mail_data));
            }
        } catch (Exception $e) {

        }

        Cart::destroy();

        if (Cache::has(domain_info('user_id') . 'order_receive_method')) {
            $method = Cache::get(domain_info('user_id') . 'order_receive_method');

        } else {
            $method = "email";
        }

        if ($method == 'whatsapp') {
            if (Cache::has(domain_info('user_id') . 'whatsapp')) {
                $whatsapp = json_decode(Cache::get(domain_info('user_id') . 'whatsapp'));
                $url = "https://wa.me/+" . $whatsapp->phone_number . "?text=My Order No Is " . str_replace('#', '', $order->order_no);
                return redirect($url);
            }

        }


        return redirect('/thanks');

    }

    public function calculateShipping($total, $shipping_amount, $weight)
    {
        $shipping_amount = (float)$shipping_amount;
        $totalAmount = $total;

        $weight_amount = $this->calculateWeight($weight, $shipping_amount);
        $amount = $totalAmount + $weight_amount;

        return $amount;

    }

    public function calculateWeight($weight, $amount)
    {
        return $amount;
    }

    public function payment_fail()
    {
        Session::flash('payment_fail', 'Sorry Transaction Failed');

        return redirect('/checkout');
    }

    public function payment_success()
    {

        if (Session::has('customer_payment_info')) {

            $data = Session::get('customer_payment_info');

            $order = Order::findorFail($data['ref_id']);
            $order->transaction_id = $data['payment_id'];
            $order->category_id = $data['getway_id'];
            if (isset($data['payment_status'])) {
                $order->payment_status = $data['payment_status'];
            } else {
                $order->payment_status = 1;
            }

            $order->save();
            Session::forget('customer_payment_info');
            Cart::destroy();


            if (Cache::has(domain_info('user_id') . 'store_email')) {
                $store_email = Cache::get(domain_info('user_id') . 'store_email');

            } else {

                $admin = User::findorFail(domain_info('user_id'));
                $store_email = $admin->email;
            }


            $mail_data['store_email'] = $store_email;
            $mail_data['order_no'] = $order->order_no;
            $mail_data['base_url'] = url('/');
            $mail_data['site_name'] = Cache::get(domain_info('user_id') . 'shop_name', null);
            $mail_data['order_url'] = url('/seller/order', $order->id);

            if (Cache::has(domain_info('user_id') . 'order_receive_method')) {
                $method = Cache::get(domain_info('user_id') . 'order_receive_method');

            } else {
                $method = "email";
            }

            if ($method == 'email') {
                if (env('QUEUE_MAIL') == 'on') {

                    dispatch(new \App\Jobs\Ordernotification($mail_data));
                } else {

                    Mail::to($store_email)->send(new SellerOrderMail($mail_data));
                }
                return redirect('/thanks');
            } else {
                if (Cache::has(domain_info('user_id') . 'whatsapp')) {
                    $whatsapp = json_decode(Cache::get(domain_info('user_id') . 'whatsapp'));
                    $url = "https://wa.me/+" . $whatsapp->phone_number . "?text=My Order No Is " . str_replace('#', '', $order->order_no);
                    return redirect($url);
                }
                if (env('QUEUE_MAIL') == 'on') {

                    dispatch(new \App\Jobs\Ordernotification($mail_data));
                } else {

                    Mail::to($store_email)->send(new SellerOrderMail($mail_data));
                }
                return redirect('/thanks');

            }


        }

        abort(404);

    }

}
