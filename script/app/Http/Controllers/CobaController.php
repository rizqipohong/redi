<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Jobs\AutoOrder;
use Illuminate\Support\Facades\DB;
use Auth;

class CobaController extends Controller
{
    public function teling()
    {
        $data = 130;
        $orders = Order::where('customer_id', Auth::guard('customer')->user()->id)
            ->where('user_id', domain_info('user_id'))->with('payment_method', 'order_content')->latest()->first();
        $order_content = json_decode($orders->order_content->value ?? '');
        if ($orders->status == 'ready-for-pickup') {
            $lengthOfString = strlen($order_content->estimation);
            $lastCharPosition = $lengthOfString - 1;
            $lastChar = ($order_content->estimation[$lastCharPosition] + 2) * 1440;
        }
        AutoOrder::dispatch($data)->delay(now()->addMinutes($lastChar));
    }
}
