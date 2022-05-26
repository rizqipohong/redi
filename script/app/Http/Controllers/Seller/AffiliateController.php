<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use Illuminate\Http\Request;
use Auth;
use App\Order;
use Illuminate\Support\Facades\DB;

class AffiliateController extends Controller
{
    public function index()
    {
        $data = DB::table('terms')
            ->join('affiliate', 'terms.id', 'affiliate.term_id')
            ->join('users', 'terms.user_id', 'users.id')
            ->join('prices', 'terms.id', 'prices.term_id')
            ->where('users.id', auth()->user()->id)
            ->select(
                'affiliate.*',
                'terms.type',
                'terms.title',
                'users.name',
                'prices.price',
                'prices.affiliate',
                'users.email'
            )
            ->orderBy('affiliate.created_at', 'DESC')
            ->get();
        $data2 = DB::table('terms')
            ->join('affiliate', 'terms.id', 'affiliate.term_id')
            ->join('users', 'terms.user_id', 'users.id')
            ->join('prices', 'terms.id', 'prices.term_id')
            ->where('users.id', auth()->user()->id)
            ->select(
                'affiliate.*',
                'terms.type',
                'terms.title',
                'users.name',
                'prices.price',
                'prices.affiliate',
                'users.email'
            )
            ->orderBy('affiliate.created_at', 'DESC')
            ->first();
        $impressions = count($data);
        $conversions = $data2->affiliate ?? '';
        return view('seller.affiliate.index', compact('data', 'impressions', 'conversions'));
    }
    public function membership()
    {
        $data = Affiliate::with('userReff', 'member', 'plan')->where('user_id', auth()->user()->id)->get();
//        return $data;
        return view('seller.affiliate.membership', compact('data'));
    }
}
