<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Order;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Userplan;
use App\Trasection;
use App\Domain;
use App\Plan;
use App\Term;
use Hash;
use App\Models\Userplanmeta;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class SellerController extends Controller
{
    protected $request;
    public function index(Request $request)
    {
        $id = auth()->user()->domain_id;
        $type = $request->type ?? 'all';
        if ($type == "trash") {
            $type = 0;
        }
        //return $request;
        if (!empty($request->src) && $request->term == "domain") {
            $this->request = $request->src;
            if ($type === 'all') {
                $posts = User::where('role_id', 3)->where('domain_id', $id)->whereHas('user_domain', function ($q) {
                    return $q->where('domain', $this->request);
                })->with('user_domain', 'user_plan')->latest()->paginate(40);
            } else {
                $posts = User::where('role_id', 3)->where('domain_id', $id)->where('status', $type)->whereHas('user_domain', function ($q) {
                    return $q->where('domain', $request->src);
                })->with('user_domain', 'user_plan')->where('status', $type)->latest()->paginate(40);
            }

        } elseif (!empty($request->src) && !empty($request->term)) {
            if ($type === 'all') {
                $posts = User::where('role_id', 3)->with('user_domain', 'user_plan')->where('domain_id', $id)->where($request->term, $request->src)->latest()->paginate(40);
            } else {
                $posts = User::where('role_id', 3)->where('domain_id', $id)->where('status', $type)->with('user_domain', 'user_plan')->where($request->term, $request->src)->latest()->paginate(40);
            }
        } else {
            if ($type === 'all') {
                $posts = User::where('role_id', 3)->with('user_domain', 'user_plan')->where('domain_id', $id)->latest()->paginate(40);
            } else {
                $posts = User::where('role_id', 3)->where('domain_id', $id)->where('status', $type)->with('user_domain', 'user_plan')->latest()->paginate(40);
            }
        }

//        return $posts;
        $all = User::where('role_id', 3)->count();
        $actives = User::where('role_id', 3)->where('status', 1)->count();
        $suspened = User::where('role_id', 3)->where('status', 2)->count();
        $trash = User::where('role_id', 3)->where('status', 0)->count();
        $requested = User::where('role_id', 3)->where('status', 4)->count();
        $pendings = User::where('role_id', 3)->where('status', 3)->count();
        return view('seller.seller.index', compact('posts', 'request', 'type', 'all', 'actives', 'suspened', 'trash', 'requested', 'pendings'));
    }
    public function create()
    {
        return view('seller.seller.create');
    }
    public function store(Request $request)
    {
        $domain_id = auth()->user()->domain_id;
        $validatedData = $request->validate([
            'email' => 'required|unique:users|email|max:255',
            'name' => 'required',
            'password' => 'required',
        ]);

        $order_prefix = \App\Option::where('key', 'order_prefix')->first();
        $price = Plan::find(4);
        if ($price->is_default == 1) {
            $validatedData = $request->validate([

                'trasection_id' => 'required',
                'trasection_method' => 'required',

            ]);
        }
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = 1;
        $user->role_id = 3;
        $user->save();

        $exp_days = $price->days;
        $expiry_date = \Carbon\Carbon::now()->addDays(($exp_days - 1))->format('Y-m-d');


        $max_id = Userplan::max('id');
        $max_id = $max_id + 1;

        $trasection = new Trasection;
        $trasection->user_id = $user->id;
        $trasection->category_id = 94; //default ratapay
        $trasection->status = 1;
        $trasection->trasection_id = rand();
        $trasection->save();


        $plan = new Userplan;
        $plan->order_no = $order_prefix->value . $max_id;
        $plan->amount = $price->price;
        $plan->user_id = $user->id;
        $plan->plan_id = 4;
        $plan->trasection_id = $trasection->id;
        $plan->will_expired = $expiry_date;
        $plan->status = 1;
        $plan->save();


        $meta = new Userplanmeta;
        $meta->user_id = $user->id;
        $meta->name = $price->name;
        $meta->product_limit = $price->product_limit;
        $meta->storage = $price->storage;
        $meta->customer_limit = $price->customer_limit;
        $meta->category_limit = $price->category_limit;
        $meta->location_limit = $price->location_limit;
        $meta->brand_limit = $price->brand_limit;
        $meta->variation_limit = $price->variation_limit;

        $meta->save();


        $user_up = User::find($user->id);
        $user_up->domain_id = $domain_id;
        $user_up->save();

        return response()->json(['Seller Created Successfully']);


    }
    public function show($id)
    {
        $info = User::withCount('term', 'orders', 'customers')->where('role_id', 3)->with('user_domain', 'user_plan')->findorFail($id);
        $histories = Userplan::with('plan_info', 'payment_method')->where('user_id', $id)->latest()->paginate(20);

        $customers = Customer::withCount('orders')->where('created_by', $id)->latest()->paginate(20);
        $guests = DB::table('guests')
            ->join('orders', 'orders.guest_id', 'guests.id')
            ->select(
                'guests.*',
                DB::raw('COUNT(orders.id) as orders_count')
            )
            ->where('created_by', $id)->latest()->paginate(20);
        $posts = \App\Term::where('user_id', $id)->latest()->paginate(40);
        return view('seller.seller.show', compact('info', 'histories', 'customers', 'posts', 'guests'));
    }

    public function orders_customer($id)
    {
        $info = Customer::withCount('orders', 'orders_complete', 'orders_processing')->findorFail($id);
        $earnings = \App\Order::where('customer_id', $id)->where('payment_status', 1)->sum('total');
        $orders = \App\Order::where('customer_id', $id)->with('payment_method')->withCount('order_item')->latest()->paginate(20);
        $returm_item =DB::table('orders')
            ->join('returnitems', 'orders.id', 'returnitems.order_id')
            ->join('terms', 'returnitems.term_id', 'terms.id')
            ->where('customer_id',$id)
            ->groupBy('returnitems.id')
            ->get();
        return view('seller.seller.customer', compact('info', 'earnings', 'orders', 'returm_item'));
    }
    public function orders_refund(Request $request)
    {
        DB::table('refunditems')->update([
            'status' => 'success'
        ]);
        Toastr::success('Post Successfully Saved :)','Success');
        return redirect()->back();
    }

    public function orders_show($id)
    {
        $info = Order::with('order_item', 'customer', 'order_content', 'shipping_info', 'getway')->findorFail($id);
        $order_content = json_decode($info->order_content->value);
        $order_shipping = $info->order_content->awb;
        $chat = DB::table('chats')->where('customer_id', $info->customer_id)
            ->orderBy('created_at')->get();
        $term = DB::table('chats')->where('customer_id', $info->customer_id)
            ->orderBy('created_at')->first();
        return view('seller.seller.order_show', compact('info', 'order_content', 'order_shipping', 'chat', 'term'));
    }

    public function orders_chat(Request $request)
    {

        DB::table('chats')
            ->insert([
                'customer_id' => $request->customer_id,
                'seller_id' => $request->seller_id,
                'comment' => $request->comment,
                'term_id' => $request->term_id,
                'attach' => $request->attach,
                'status' => 0,
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        return redirect('/admin/customer/orders/show/'.$request->order_id.'');

    }

    public function orders_guest($id)
    {
        $info = Guest::withCount('orders', 'orders_complete', 'orders_processing')->findorFail($id);
        $earnings = \App\Order::where('guest_id', $id)->where('payment_status', 1)->sum('total');
        $orders = \App\Order::where('guest_id', $id)->with('payment_method')->withCount('order_item')->latest()->paginate(20);
        return view('seller.seller.customer', compact('info', 'earnings', 'orders'));
    }

    public function planview($id)
    {
        $info = User::withCount('term', 'orders', 'customers')->where('role_id', 3)->findorFail($id);

        $planinfo = Userplanmeta::where('user_id', $id)->first();
        abort_if(empty($planinfo), 404);
        return view('seller.seller.planinfo', compact('info', 'planinfo'));
    }

    public function updateplaninfo(Request $request, $id)
    {
        $planinfo = Userplanmeta::findorFail($id);
        $planinfo->product_limit = $request->product_limit;
        $planinfo->storage = $request->storage;
        $planinfo->customer_limit = $request->customer_limit;
        $planinfo->category_limit = $request->category_limit;
        $planinfo->location_limit = $request->location_limit;
        $planinfo->brand_limit = $request->brand_limit;
        $planinfo->variation_limit = $request->variation_limit;
        $planinfo->save();

        return response()->json('Info Updated Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = User::findorFail($id);
        return view('seller.seller.edit', compact('info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:users,email,' . $id,
        ]);

        $user = User::findorFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->status = $request->status;
        $user->save();

        return response()->json(['User Updated Successfully']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->type == "term_delete") {
            foreach ($request->ids ?? [] as $key => $id) {
                \App\Term::destroy($id);
            }
        } elseif ($request->type == "user_delete") {
            foreach ($request->ids ?? [] as $key => $id) {
                \App\Models\Customer::destroy($id);
            }
        } else {
            if (!empty($request->method)) {
                if ($request->method == "delete") {
                    foreach ($request->ids ?? [] as $key => $id) {
                        \File::deleteDirectory('uploads/' . $id);
                        $user = User::destroy($id);
                    }
                } else {
                    foreach ($request->ids ?? [] as $key => $id) {
                        $user = User::find($id);
                        if ($request->method == "trash") {
                            $user->status = 0;
                        } else {
                            $user->status = $request->method;
                        }
                        $user->save();
                    }
                }
            }

        }

        return response()->json(['Success']);


    }
}
