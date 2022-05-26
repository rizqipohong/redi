<?php

namespace App\Helper\Order;

use Illuminate\Http\Request;
use Auth;
use Session;
use Illuminate\Support\Facades\Http;
use Redirect;
use Illuminate\Http\RedirectResponse;
use App\Order;
use App\Getway;
use App\Mail\SellerOrderMail;
use App\Models\User;
use App\Ordermeta;
use Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class Ratapay
{
    protected static $payment_id;

    public static function make_payment()
    {
        $array = Session::get('customer_order_info');
        $amount = $array['amount'];

        $phone = $array['phone'];
        $email = $array['email'];
        $amount = $array['amount'];
        $ref_id = $array['ref_id'];
        $getway_id = $array['getway_id'];
        $name = $array['name'];
        $billName = $array['billName'];
        $refund_threshold = $array['refund_threshold'];
        $note = $billName;

//        item_list
        $array_item = Session::get('customer_items_info');
        foreach ($array_item as $key => $value) {
            $items[] = array(
                'id' => $value['term_id'],
                'qty' => $value['qty'],
                'subtotal' => $value['qty'] * $value['amount'],
                'name' => $value['product'],
                'type' => $value['type'],
                'category' => $value['category'],
                'brand' => '',
                'jv' => 'seller@mail.com',
                'aff' => 'aff@mail.com',
                'refundable' => 1,
                'refund_threshold' => $refund_threshold . 'D'
            );
        }
//        shippling list
        $items[] = array(
            'id' => rand(),
            'qty' => '1',
            'subtotal' => $array['shipping'],
            'name' => 'Shipping',
            'type' => $value['type'],
            'category' => $value['category'],
            'brand' => '',
            'jv' => 'seller@mail.com',
            'aff' => 'aff@mail.com',
            'refundable' => 1,
            'refund_threshold' => $refund_threshold . 'D'
        );
//        aff_list
        $vendor[] = array(
            'id' => rand(),
            'qty' => '1',
            'subtotal' => $array['shipping'],
            'name' => 'Shipping',
            'type' => $value['type'],
            'category' => $value['category'],
            'brand' => '',
            'jv' => 'seller@mail.com',
            'aff' => 'aff@mail.com',
            'refundable' => 1,
            'refund_threshold' => $refund_threshold . 'D'
        );
        $aff_item = Session::get('customer_aff_info');
        if  (isset($aff_item)){
            $affComm = [];
            $affComm[] = array(
                'email' => $aff_item['email'],
                'share_amount' => $aff_item['share_amount'],
                'rebill_share_amount' => $aff_item['share_amount'],
                'share_type' => 'fixed',
                'share_item_id' => 1
            );
        }

        $user_id = domain_info('user_id');
        $gwData = Getway::where('user_id', $user_id)->where('category_id', $getway_id)->first();
        $gwCreds = json_decode($gwData->content);

        $postData = array(
            'email' => $email,
            'phone' => $phone,
            'name' => $name,
            'type' => 0,
            'amount' => $amount,
            'items' => $items,
            'second_amount' => 0,
            'first_period' => '',
            'second_period' => '',
            'rebill_times' => '0',
            'source_invoice_id' => '#RPMINV-' . $ref_id,
            'note' => $note,
            'currency' => 'IDR',
            'ts' => time(),
            'url_callback' => Ratapay::callback(),
            'url_success' => Ratapay::redirect_if_payment_success(),
            'url_failed' => Ratapay::redirect_if_payment_faild(),
            'aff_share' => [],
            'vendor_share' => [],
            'refundable' => 1,
            'refund_threshold' => $refund_threshold . 'D',
            'merchant_id' => env('RATAPAY_GW_CLIENT_ID'),
            'pay_balance' => 1,
            'for_merchant_id' => $gwCreds->key_id
        );

        $resBody = Ratapay::postTransaction($postData);
        if (empty($resBody) || $resBody['success'] != 1) {
            throw new Exception('Maintenance in service courier');
        }

        $payment_link = env('RATAPAY_GW_APP_URI') . '/payment/' . $resBody['invoice_data']['ref'];
        $om = Ordermeta::where('order_id', $ref_id)->where('key', 'content')->first();
        $omData = json_decode($om->value);
        $omData->payment_link = $payment_link;
        $om->value = json_encode($omData);
        $om->save();
        return redirect($payment_link);
    }

    public static function callback()
    {
        return url('/payment/ratapay');
    }

    public static function redirect_if_payment_success()
    {
        return url('/user/dahboard');
    }

    public static function redirect_if_payment_faild()
    {
        return url('/payment/payment-fail');
    }

    public static function postTransaction($postData)
    {
        foreach ($postData as $key => $value) {
            if (empty($value)) {
                unset($postData[$key]);
            }
        }

        $client = new Client();

        $serializedPostData = json_encode($postData);
        $postHash = hash_hmac('sha256', $serializedPostData, env('RATAPAY_GW_CLIENT_SECRET'));
        $postData['hash'] = $postHash;

        try {
            $res = $client->post(env('RATAPAY_GW_API_URI') . '/admin/transaction', [
                'headers' => ['content-type' => 'application/json', 'authorization' => 'Bearer ' . env('RATAPAY_GW_TOKEN')],
                'json' => ['data' => $serializedPostData, 'hash' => $postHash],
            ]);
            $resBody = (string)$res->getBody();
            // error_log(print_r($resBody, true));
            $resBody = json_decode($resBody, true);
            return $resBody;
        } catch (ClientException $exc) {
            throw new Exception($exc->getMessage());
        }

    }

    public function view()
    {
        if (Session::has('razorpay_payment') && Session::get('customer_order_info')) {
            $array = Session::get('customer_order_info');
            $amount = $array['amount'];
            $user_id = domain_info('user_id');
            $data = Getway::where('user_id', $user_id)->where('category_id', $array['getway_id'])->first();
            $info = json_decode($data->content);

            $credentials['key_id'] = $info->key_id;
            $credentials['key_secret'] = $info->key_secret;
            $credentials['currency'] = $info->currency;

            if (Session::has('razorpay_credentials')) {
                Session::forget('razorpay_credentials');
            }
            Session::put('razorpay_credentials', $credentials);

            $Info = Razorpay::make_payment();

            return view(base_view() . '.payment.razorpay', compact('amount', 'Info'));
        }
        abort(404);
    }

    public function status(Request $request)
    {
        if (!isset($request->data) || !isset($request->hash)) {
            echo '{"success":0}';
            exit();
        }
        $decoded = json_decode($request->data, true);
        $encoded = json_encode($decoded);
        $hashRemote = ($request->hash);

        $user_id = domain_info('user_id');
        $gwData = Getway::where('user_id', $user_id)->where('category_id', 94)->first();
        $gwCreds = json_decode($gwData->content);

        $calculatedHash = hash_hmac('sha256', $encoded, $gwCreds->key_secret);
        if (hash_equals($calculatedHash, $hashRemote)) {
            if (time() - intval($decoded['ts']) > 300) {
                \Log::error('IPN request expired. data: ' . $encoded);
                echo '{"success":0}';
                exit();
            } else {
                // 1 means succesful payment
                if ($decoded['action'] == 1) {
                    $ref_id = explode('-', $decoded['invoice_id'])[1];
                    $order = Order::findorFail($ref_id);
                    $order->transaction_id = $decoded['ref'];
                    $order->category_id = 94;
                    $order->payment_status = 1;

                    $order->save();
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

                    if (env('QUEUE_MAIL') == 'on') {
                        dispatch(new \App\Jobs\Ordernotification($mail_data));
                    } else {
                        Mail::to($store_email)->send(new SellerOrderMail($mail_data));
                    }
                    return response()->json(['success' => 1]);
                }
            }
        }
    }
}
