<?php

namespace App\Http\Controllers\Admin;

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
        $data = Affiliate::with('userReff', 'member', 'plan')->get();
//        return $data;
        return view('admin.affiliate.index', compact('data'));
    }
}
