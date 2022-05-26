<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Hash;
use App\Order;
use Cache;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function auto_order_completed($id)
    {
        DB::table('orders')->where('id', $id)->update([
           'status' => 'completed'
        ]);
        return redirect()->back();
    }
    public function order_completed(Request $request)
    {
        DB::table('orders')->where('id', $request->order_id)->update([
            'status' => 'completed'
        ]);
        return redirect('/guest/dashboard/'  . $request->id);
    }
    public function settings($id)
    {
        SEOTools::setTitle('Settings');
        $user = DB::table('guests')->where('url', 'like', '%' . $id . '%')->first();
        return view(base_view() . '.guest.account', compact('id', 'user'));
    }

    public function orders($id)
    {
        SEOTools::setTitle('Orders');
        $check = DB::table('guests')->where('url', 'like', '%' . $id . '%')->first();
        $orders = Order::where('guest_id', $check->id)->where('user_id', domain_info('user_id'))->with('payment_method')->latest()->paginate(20);
        return view(base_view() . '.guest.orders', compact('orders', 'id'));
    }

    public function order_view($id, $id_order)
    {
        SEOTools::setTitle('Orders');
        $check = DB::table('guests')->where('url', 'like', '%' . $id . '%')->first();
        $id_order = request()->route()->parameter('id_order');
        $info = Order::where('guest_id', $check->id)->where('user_id', domain_info('user_id'))->with('order_item_with_file', 'order_content', 'shipping_info', 'payment_method')->findorFail($id_order);
        $order_content = json_decode($info->order_content->value);
        SEOTools::setTitle('Order No ' . $info->order_no);
        return view(base_view() . '.guest.order_view', compact('info', 'order_content', 'id'));
    }

    public function dashboard($id)
    {
        SEOTools::setTitle('Dashboard');
        $check = DB::table('guests')->where('url', 'like', '%' . $id . '%')->first();
        $orders = Order::where('guest_id', $check->id)
            ->where('user_id', domain_info('user_id'))->with('payment_method', 'order_content')->latest()->first();
        $order_content=json_decode($orders->order_content->value ?? '');
        if ($orders->status == 'ready-for-pickup'){
            $lengthOfString = strlen($order_content->estimation);
            $lastCharPosition = $lengthOfString-1;
            $lastChar = ($order_content->estimation[$lastCharPosition] + 2) * 86400;
            if ($check == TRUE) {
                return view(base_view() . '.guest.dashboard', compact('id', 'orders', 'order_content', 'lastChar'));
            } else {
                echo 'not found';
            }
        }else{
            if ($check == TRUE) {
                return view(base_view() . '.guest.dashboard', compact('id', 'orders', 'order_content'));
            } else {
                echo 'not found';
            }
        }

    }
}
