<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Order;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatisticController extends Controller
{
    public function index(Request $request)
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        if (request()->date != '') {
            $date = explode(' - ', request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
            $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
        }
        $data = DB::table('aff_product')
            ->join('terms', 'aff_product.term_id', 'terms.id')
            ->join('orderitems', 'aff_product.term_id', 'orderitems.term_id')
            ->whereBetween('aff_product.created_at', [$start, $end])
            ->select(
                DB::raw("SUM(aff_product.views) as views"),
                DB::raw("SUM(aff_product.click_share) as click_share"),
                DB::raw("SUM(aff_product.click_cart) as click_cart"),
                DB::raw("SUM(aff_product.click_like) as click_like"),
                'aff_product.static_date',
                'terms.title',
                DB::raw("COUNT(orderitems.term_id) as total_sales"),
            )
            ->groupBy('terms.title')
            ->orderBy('total_sales', 'desc')
            ->get();
        return view('seller.statistic.index', compact('data'));
    }

    public function show($id)
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        if (request()->date != '') {
            $date = explode(' - ', request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
            $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
        }
        $data = DB::table('aff_product')
            ->join('terms', 'aff_product.term_id', 'terms.id')
            ->join('orderitems', 'aff_product.term_id', 'orderitems.term_id')
            ->whereBetween('aff_product.created_at', [$start, $end])
            ->where('aff_product.term_id', $id)
            ->select(
                DB::raw("SUM(aff_product.views) as views"),
                DB::raw("SUM(aff_product.click_share) as click_share"),
                DB::raw("SUM(aff_product.click_cart) as click_cart"),
                DB::raw("SUM(aff_product.click_like) as click_like"),
                'aff_product.static_date',
                'terms.title',
                DB::raw("COUNT(orderitems.term_id) as total_sales"),

            )
            ->groupBy('terms.title')
            ->get();
        return view('seller.statistic.index', compact('data'));
    }

    public function notif($id)
    {
        DB::table('ordernotif')->where('id', $id)->update([
            'status' => 1
        ]);
    }
}
