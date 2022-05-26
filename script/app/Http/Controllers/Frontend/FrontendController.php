<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Api\Traits\BaseCRUL;
use App\Http\Controllers\Controller;
use App\Jobs\TermStat;
use Illuminate\Http\Request;
use App\Term;
use App\Category;
use App\Attribute;
use App\Getway;
use App\Models\Review;
use Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Session;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;
use App\Useroption;
use URL;
use App\Option;
use App\Plan;
use Auth;

class FrontendController extends Controller
{

    public $cats;
    public $attrs;
    private $baseCRUL;

    public function __construct(BaseCRUL $baseCRUL)
    {
        $this->baseCRUL = $baseCRUL;
    }

    public function share_stat($slug, $id)
    {
        $check_data = DB::table("aff_product")->get();
        $check_date = DB::table("aff_product")->where('term_id', $id)->orderBy('static_date', 'desc')->first();
        $date = date('Y-m-d');
        if (empty($check_data)) {
            DB::table("aff_product")->insert([
                'term_id' => $id,
                'click_share' => 1,
                'static_date' => $date,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        } else {
            if ($check_date == false) {
                DB::table("aff_product")->insert([
                    'term_id' => $id,
                    'click_share' => 1,
                    'static_date' => $date,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            } else {
                if ($check_date->static_date == $date && $check_date->term_id == $id) {
                    DB::table("aff_product")
                        ->where('term_id', $check_date->term_id)
                        ->where('static_date', $check_date->static_date)
                        ->update([
                            'click_share' => $check_date->click_share + 1,
                        ]);
                } else {
                    DB::table("aff_product")->insert([
                        'term_id' => $id,
                        'click_share' => 1,
                        'static_date' => $date,
                        'created_at' => $date,
                        'updated_at' => $date,
                    ]);
                }
            }
        }
    }

    public function like_stat($slug, $id)
    {
        $check_data = DB::table("aff_product")->get();
        $check_date = DB::table("aff_product")->where('term_id', $id)->orderBy('static_date', 'desc')->first();
        $date = date('Y-m-d');
        if (empty($check_data)) {
            DB::table("aff_product")->insert([
                'term_id' => $id,
                'click_like' => 1,
                'static_date' => $date,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        } else {
            if ($check_date == false) {
                DB::table("aff_product")->insert([
                    'term_id' => $id,
                    'click_like' => 1,
                    'static_date' => $date,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            } else {
                if ($check_date->static_date == $date && $check_date->term_id == $id) {
                    DB::table("aff_product")
                        ->where('term_id', $check_date->term_id)
                        ->where('static_date', $check_date->static_date)
                        ->update([
                            'click_like' => $check_date->click_like + 1,
                        ]);
                } else {
                    DB::table("aff_product")->insert([
                        'term_id' => $id,
                        'click_like' => 1,
                        'static_date' => $date,
                        'created_at' => $date,
                        'updated_at' => $date,
                    ]);
                }
            }
        }
    }

    public function cart_stat($slug, $id)
    {
        $check_data = DB::table("aff_product")->get();
        $check_date = DB::table("aff_product")->where('term_id', $id)->orderBy('static_date', 'desc')->first();
        $date = date('Y-m-d');
        if (empty($check_data)) {
            DB::table("aff_product")->insert([
                'term_id' => $id,
                'click_cart' => 1,
                'static_date' => $date,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        } else {
            if ($check_date == false) {
                DB::table("aff_product")->insert([
                    'term_id' => $id,
                    'click_cart' => 1,
                    'static_date' => $date,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            } else {
                if ($check_date->static_date == $date && $check_date->term_id == $id) {
                    DB::table("aff_product")
                        ->where('term_id', $check_date->term_id)
                        ->where('static_date', $check_date->static_date)
                        ->update([
                            'click_cart' => $check_date->click_cart + 1,
                        ]);
                } else {
                    DB::table("aff_product")->insert([
                        'term_id' => $id,
                        'click_cart' => 1,
                        'static_date' => $date,
                        'created_at' => $date,
                        'updated_at' => $date,
                    ]);
                }
            }
        }
    }

    public function index(Request $request)
    {

        $url = $request->getHost();
        $url = str_replace('www.', '', $url);

        if (url('/') == env('APP_URL') || $url == 'localhost') {
            $seo = Option::where('key', 'seo')->first();
            $seo = json_decode($seo->value);

            JsonLdMulti::setTitle($seo->title ?? env('APP_NAME'));
            JsonLdMulti::setDescription($seo->description ?? null);
            JsonLdMulti::addImage(asset('uploads/logo.png'));

            SEOMeta::setTitle($seo->title ?? env('APP_NAME'));
            SEOMeta::setDescription($seo->description ?? null);
            SEOMeta::addKeyword($seo->tags ?? null);

            SEOTools::setTitle($seo->title ?? env('APP_NAME'));
            SEOTools::setDescription($seo->description ?? null);
            SEOTools::setCanonical($seo->canonical ?? url('/'));
            SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
            SEOTools::opengraph()->addProperty('image', asset('uploads/logo.png'));
            SEOTools::twitter()->setTitle($seo->title ?? env('APP_NAME'));
            SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
            SEOTools::jsonLd()->addImage(asset('uploads/logo.png'));


            $latest_gallery = Category::where('type', 'gallery')->with('preview')->where('is_admin', 1)->latest()->take(15)->get();
            $features = Category::where('type', 'features')->with('preview', 'excerpt')->where('is_admin', 1)->latest()->get();

            $testimonials = Category::where('type', 'testimonial')->with('excerpt')->where('is_admin', 1)->latest()->get();

            $brands = Category::where('type', 'brand')->with('preview')->where('is_admin', 1)->latest()->get();

            $plans = Plan::where('status', 1)->get();
            $header = Option::where('key', 'header')->first();
            $header = json_decode($header->value ?? '');

            $about_1 = Option::where('key', 'about_1')->first();
            $about_1 = json_decode($about_1->value ?? '');

            $about_2 = Option::where('key', 'about_2')->first();
            $about_2 = json_decode($about_2->value ?? '');

            $about_3 = Option::where('key', 'about_3')->first();
            $about_3 = json_decode($about_3->value ?? '');

            $ecom_features = Option::where('key', 'ecom_features')->first();
            $ecom_features = json_decode($ecom_features->value ?? '');

            $counter_area = Option::where('key', 'counter_area')->first();
            $counter_area = json_decode($counter_area->value ?? '');

            return view('welcome', compact('latest_gallery', 'plans', 'features', 'header', 'about_1', 'about_3', 'about_2', 'testimonials', 'brands', 'ecom_features', 'counter_area'));
        }

        if ($url == env('APP_PROTOCOLESS_URL')) {
            return redirect('/check');
        }

        if (Cache::has(domain_info('user_id') . 'seo')) {
            $seo = json_decode(Cache::get(domain_info('user_id') . 'seo'));
        } else {
            $data = Useroption::where('user_id', domain_info('user_id'))->where('key', 'seo')->first();
            $seo = json_decode($data->value ?? '');
        }
        JsonLdMulti::setTitle($seo->title ?? env('APP_NAME'));
        JsonLdMulti::setDescription($seo->description ?? null);
        JsonLdMulti::addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));

        SEOMeta::setTitle($seo->title ?? env('APP_NAME'));
        SEOMeta::setDescription($seo->description ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle($seo->title ?? env('APP_NAME'));
        SEOTools::setDescription($seo->description ?? null);
        SEOTools::setCanonical($seo->canonical ?? url('/'));
        SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
        SEOTools::opengraph()->addProperty('image', asset('uploads/' . domain_info('user_id') . '/logo.png'));
        SEOTools::twitter()->setTitle($seo->title ?? env('APP_NAME'));
        SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
        SEOTools::jsonLd()->addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));

        return view(base_view() . '.index');
    }

    public function page()
    {
        $id = request()->route()->parameter('id');
        $info = Term::where('user_id', domain_info('user_id'))->where('type', 'page')->with('excerpt', 'content')->findorFail($id);
        JsonLdMulti::setTitle($info->title ?? env('APP_NAME'));
        JsonLdMulti::setDescription($info->excerpt->value ?? null);
        JsonLdMulti::addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));

        SEOMeta::setTitle($info->title ?? env('APP_NAME'));
        SEOMeta::setDescription($info->excerpt->value ?? null);

        SEOTools::setTitle($info->title ?? env('APP_NAME'));
        SEOTools::setDescription($info->excerpt->value ?? null);
        SEOTools::setCanonical(url('/'));
        SEOTools::opengraph()->addProperty('image', asset('uploads/' . domain_info('user_id') . '/logo.png'));
        SEOTools::twitter()->setTitle($info->title ?? env('APP_NAME'));
        SEOTools::twitter()->setSite($info->title ?? null);
        SEOTools::jsonLd()->addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));


        return view(base_view() . '.page', compact('info'));
    }

    public function sitemap()
    {
        if (!file_exists('uploads/' . domain_info('user_id') . '/sitemap.xml')) {
            abort(404);
        }
        return response(file_get_contents('uploads/' . domain_info('user_id') . '/sitemap.xml'), 200, [
            'Content-Type' => 'application/xml'
        ]);
    }


    public function shop(Request $request)
    {
        if (Cache::has(domain_info('user_id') . 'seo')) {
            $seo = json_decode(Cache::get(domain_info('user_id') . 'seo'));
        } else {
            $data = Useroption::where('user_id', domain_info('user_id'))->where('key', 'seo')->first();
            $seo = json_decode($data->value ?? '');
        }
        if (!empty($seo)) {
            JsonLdMulti::setTitle('Shop - ' . $seo->title ?? env('APP_NAME'));
            JsonLdMulti::setDescription($seo->description ?? null);
            JsonLdMulti::addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));

            SEOMeta::setTitle('Shop - ' . $seo->title ?? env('APP_NAME'));
            SEOMeta::setDescription($seo->description ?? null);
            SEOMeta::addKeyword($seo->tags ?? null);

            SEOTools::setTitle('Shop - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::setDescription($seo->description ?? null);
            SEOTools::setCanonical($seo->canonical ?? url('/'));
            SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
            SEOTools::opengraph()->addProperty('image', asset('uploads/' . domain_info('user_id') . '/logo.png'));
            SEOTools::twitter()->setTitle('Shop - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
            SEOTools::jsonLd()->addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));
        }


        $src = $request->src ?? null;
        return view(base_view() . '.shop', compact('src'));
    }

    public function cart()
    {

        if (\Cart::count() <= 0) {
            return view(base_view() . '.cartEmpty');
        } else {
            \Cart::setGlobalTax(tax());
            if (Cache::has(domain_info('user_id') . 'seo')) {
                $seo = json_decode(Cache::get(domain_info('user_id') . 'seo'));
            } else {
                $data = Useroption::where('user_id', domain_info('user_id'))->where('key', 'seo')->first();
                $seo = json_decode($data->value ?? '');
            }
            if (!empty($seo)) {
                JsonLdMulti::setTitle('Cart - ' . $seo->title ?? env('APP_NAME'));
                JsonLdMulti::setDescription($seo->description ?? null);
                JsonLdMulti::addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));

                SEOMeta::setTitle('Cart - ' . $seo->title ?? env('APP_NAME'));
                SEOMeta::setDescription($seo->description ?? null);
                SEOMeta::addKeyword($seo->tags ?? null);

                SEOTools::setTitle('Cart - ' . $seo->title ?? env('APP_NAME'));
                SEOTools::setDescription($seo->description ?? null);
                SEOTools::setCanonical($seo->canonical ?? url('/'));
                SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
                SEOTools::opengraph()->addProperty('image', asset('uploads/' . domain_info('user_id') . '/logo.png'));
                SEOTools::twitter()->setTitle('Cart - ' . $seo->title ?? env('APP_NAME'));
                SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
                SEOTools::jsonLd()->addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));
            }
            if (Auth::guard('customer')->check()) {
                $user_id = domain_info('user_id');
                $customer_id = Auth::guard('customer')->user()->id;
                $address = DB::table('useraddress')->where('customer_id', $customer_id)->get();
                $weight = DB::table('stocks')->get();
                $city_code = DB::table('useroptions')->where('user_id', $user_id)->where('key', 'location')->first();
                $city = DB::table('origin')->where('origin_code', json_decode($city_code->value)->city)->first();
                return view(base_view() . '.cart', compact('address', 'weight', 'city_code', 'city'));
            }
            return view(base_view() . '.cart');
        }

    }

    public function wishlist()
    {
        if (Cache::has(domain_info('user_id') . 'seo')) {
            $seo = json_decode(Cache::get(domain_info('user_id') . 'seo'));
        } else {
            $data = Useroption::where('user_id', domain_info('user_id'))->where('key', 'seo')->first();
            $seo = json_decode($data->value ?? '');
        }
        if (!empty($seo)) {
            JsonLdMulti::setTitle('Wishlist - ' . $seo->title ?? env('APP_NAME'));
            JsonLdMulti::setDescription($seo->description ?? null);
            JsonLdMulti::addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));

            SEOMeta::setTitle('Wishlist - ' . $seo->title ?? env('APP_NAME'));
            SEOMeta::setDescription($seo->description ?? null);
            SEOMeta::addKeyword($seo->tags ?? null);

            SEOTools::setTitle('Wishlist - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::setDescription($seo->description ?? null);
            SEOTools::setCanonical($seo->canonical ?? url('/'));
            SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
            SEOTools::opengraph()->addProperty('image', asset('uploads/' . domain_info('user_id') . '/logo.png'));
            SEOTools::twitter()->setTitle('Wishlist - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
            SEOTools::jsonLd()->addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));
        }


        return view(base_view() . '.wishlist');
    }

    public function thanks()
    {
        if (Cache::has(domain_info('user_id') . 'seo')) {
            $seo = json_decode(Cache::get(domain_info('user_id') . 'seo'));
        } else {
            $data = Useroption::where('user_id', domain_info('user_id'))->where('key', 'seo')->first();
            $seo = json_decode($data->value ?? '');
        }
        if (!empty($seo)) {
            JsonLdMulti::setTitle('Thank you - ' . $seo->title ?? env('APP_NAME'));
            JsonLdMulti::setDescription($seo->description ?? null);
            JsonLdMulti::addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));

            SEOMeta::setTitle('Thank you - ' . $seo->title ?? env('APP_NAME'));
            SEOMeta::setDescription($seo->description ?? null);
            SEOMeta::addKeyword($seo->tags ?? null);

            SEOTools::setTitle('Thank you - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::setDescription($seo->description ?? null);
            SEOTools::setCanonical($seo->canonical ?? url('/'));
            SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
            SEOTools::opengraph()->addProperty('image', asset('uploads/' . domain_info('user_id') . '/logo.png'));
            SEOTools::twitter()->setTitle('Thank you - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
            SEOTools::jsonLd()->addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));
        }
        return view(base_view() . '.thanks');
    }

    public function make_local(Request $request)
    {
        Session::put('locale', $request->lang);
        \App::setlocale($request->lang);

        return redirect('/');
    }

    public function checkout(Request $request)
    {
//return $request->all();

        if (Auth::check() == true) {
            Auth::logout();
        }
        \Cart::setGlobalTax(tax());


        if (Cache::has(domain_info('user_id') . 'seo')) {
            $seo = json_decode(Cache::get(domain_info('user_id') . 'seo'));
        } else {
            $data = Useroption::where('user_id', domain_info('user_id'))->where('key', 'seo')->first();
            $seo = json_decode($data->value ?? '');
        }
        if (!empty($seo)) {
            JsonLdMulti::setTitle('Checkout - ' . $seo->title ?? env('APP_NAME'));
            JsonLdMulti::setDescription($seo->description ?? null);
            JsonLdMulti::addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));

            SEOMeta::setTitle('Checkout - ' . $seo->title ?? env('APP_NAME'));
            SEOMeta::setDescription($seo->description ?? null);
            SEOMeta::addKeyword($seo->tags ?? null);

            SEOTools::setTitle('Checkout - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::setDescription($seo->description ?? null);
            SEOTools::setCanonical($seo->canonical ?? url('/'));
            SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
            SEOTools::opengraph()->addProperty('image', asset('uploads/' . domain_info('user_id') . '/logo.png'));
            SEOTools::twitter()->setTitle('Checkout - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
            SEOTools::jsonLd()->addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));
        }

        $shop_type = domain_info('shop_type');
        $user_id = domain_info('user_id');
        if ($shop_type == 1) {
            $locations = Category::where('user_id', $user_id)->where('type', 'city')->with('child_relation')->get();
        } else {
            $locations = [];
        }
        $count = count($request->id_product);
        $order = DB::table('cart')->where('customer_id', Auth::guard('customer')->user()->id)->delete();
        $is_dropship = $request->location;
        if(!is_null($is_dropship)) {
            for ($i = 0; $i < $count; $i++) {
                DB::table('cart')->insert([
                    'term_id' => $request->id_product[$i],
                    'customer_id' => Auth::guard('customer')->user()->id,
                    'qty' => $request->qty[$i],
                    'weight' => $request->weight[$i],
                    'subtotal' => $request->total_semua[$i],
                    'price' => $request->price[$i],
                    'origin' => $request->origin,
                    'destination' => 5,
                    'primary_shipping_mode' => 270000,
                    'drosphip_name' => $request->drosphip_name[$i],
                    'drosphip_number' => $request->drosphip_number[$i],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }else{
            for ($i = 0; $i < $count; $i++) {
                DB::table('cart')->insert([
                    'term_id' => $request->id_product[$i],
                    'customer_id' => Auth::guard('customer')->user()->id,
                    'qty' => $request->qty[$i],
                    'weight' => $request->weight[$i],
                    'subtotal' => $request->total_semua[$i],
                    'price' => $request->price[$i],
                    'origin' => $request->origin,
                    'destination' => $request->primary_address,
                    'primary_shipping_mode' => $request->primary_shipping_mode,
                    'drosphip_name' => $request->drosphip_name[$i],
                    'drosphip_number' => $request->drosphip_number[$i],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $get_order = DB::table('cart')
            ->LeftJoin('terms', 'cart.term_id', 'terms.id')
            ->LeftJoin('postmedia', 'cart.term_id', 'postmedia.term_id')
            ->LeftJoin('media', 'postmedia.media_id', 'media.id')
            ->LeftJoin('useraddress', 'cart.destination', 'useraddress.address_id')
            ->where('cart.customer_id', Auth::guard('customer')->user()->id)
            ->groupBy('cart.id')
            ->get();
//        return $get_order;
        $getways = Getway::where('user_id', $user_id)->where('status', 1)->get();
        foreach ($request->drosphip_name as $drop) {
            if (is_null($drop)) {
                return view(base_view() . '.checkout', compact('getways', 'get_order'));
            } else {
                return view(base_view() . '.checkoutDrop', compact('getways', 'get_order'));
            }
        }

    }

    public function old_checkout()
    {
        if (Auth::check() == true) {
            Auth::logout();
        }
        \Cart::setGlobalTax(tax());


        if (Cache::has(domain_info('user_id') . 'seo')) {
            $seo = json_decode(Cache::get(domain_info('user_id') . 'seo'));
        } else {
            $data = Useroption::where('user_id', domain_info('user_id'))->where('key', 'seo')->first();
            $seo = json_decode($data->value ?? '');
        }
        if (!empty($seo)) {
            JsonLdMulti::setTitle('Checkout - ' . $seo->title ?? env('APP_NAME'));
            JsonLdMulti::setDescription($seo->description ?? null);
            JsonLdMulti::addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));

            SEOMeta::setTitle('Checkout - ' . $seo->title ?? env('APP_NAME'));
            SEOMeta::setDescription($seo->description ?? null);
            SEOMeta::addKeyword($seo->tags ?? null);

            SEOTools::setTitle('Checkout - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::setDescription($seo->description ?? null);
            SEOTools::setCanonical($seo->canonical ?? url('/'));
            SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
            SEOTools::opengraph()->addProperty('image', asset('uploads/' . domain_info('user_id') . '/logo.png'));
            SEOTools::twitter()->setTitle('Checkout - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
            SEOTools::jsonLd()->addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));
        }

        $shop_type = domain_info('shop_type');
        $user_id = domain_info('user_id');
        if ($shop_type == 1) {
            $locations = Category::where('user_id', $user_id)->where('type', 'city')->with('child_relation')->get();
        } else {
            $locations = [];
        }


        $getways = Getway::where('user_id', $user_id)->where('status', 1)->get();
        $destination = DB::table('destination')->groupBy('province')
            ->get();
        $city_code = DB::table('useroptions')->where('user_id', $user_id)->where('key', 'location')->first();
        $city = DB::table('origin')->where('origin_code', json_decode($city_code->value)->city)->first();
        $weight = DB::table('stocks')->get();
//        return $weight;
        return view(base_view() . '.checkout', compact('locations', 'getways', 'destination', 'city_code', 'city', 'weight'));
    }

    public function get_city(Request $request)
    {
        $cities = DB::table('destination')->where('province', $request->id)->groupBy('city')->pluck('city', 'id');
        return response()->json($cities);
    }

    public function get_district(Request $request)
    {
        $district = DB::table('destination')->where('city', $request->id)->groupBy('district')->pluck('district', 'id');
        return response()->json($district);
    }

    public function get_subdistrict(Request $request)
    {
        $subdistrict = DB::table('destination')->where('district', $request->id)->pluck('subdistrict', 'tariff_code');
        return response()->json($subdistrict);
    }

    public function get_cost(Request $request)
    {
        $grand_total = $request->total;
        $cost = DB::table('destination')->where('subdistrict', $request->id)->first();
        $CURLOPT_URL = env('API_JNE_URL');
        $CURLOPT_CUSTOMREQUEST = 'POST';
        $CURLPOST_DATA = [
            'username' => env('API_JNE_USERNAME'),
            'api_key' => env('API_JNE_KEY'),
            'from' => $request->code,
            'thru' => $request->tariff_code,
            'weight' => $request->weight,
        ];

        $response = $this->baseCRUL->API_POST($CURLOPT_URL, $CURLOPT_CUSTOMREQUEST, $CURLPOST_DATA);

        $data = json_decode($response, TRUE);

        return view('frontend.cost', compact('data', 'grand_total'));
//        return response()->json($data);
    }

    public function get_cost2(Request $request)
    {
        $grand_total = $request->total;
        $cost = DB::table('destination')->where('subdistrict', $request->id)->first();
        $CURLOPT_URL = env('API_JNE_URL');
        $CURLOPT_CUSTOMREQUEST = 'POST';
        $CURLPOST_DATA = [
            'username' => env('API_JNE_USERNAME'),
            'api_key' => env('API_JNE_KEY'),
            'from' => $request->code,
            'thru' => $cost->tariff_code,
            'weight' => $request->weight,
        ];

        $response = $this->baseCRUL->API_POST($CURLOPT_URL, $CURLOPT_CUSTOMREQUEST, $CURLPOST_DATA);

        $data = json_decode($response, TRUE);

        return view('frontend.cost2', compact('data', 'grand_total'));
//        return response()->json($data);
    }

    public function cost_primary(Request $request)
    {
        $grand_total = $request->total;
        $cost = DB::table('destination')->where('subdistrict', $request->id)->first();
        $CURLOPT_URL = env('API_JNE_URL');
        $CURLOPT_CUSTOMREQUEST = 'POST';
        $CURLPOST_DATA = [
            'username' => env('API_JNE_USERNAME'),
            'api_key' => env('API_JNE_KEY'),
            'from' => $request->code,
            'thru' => $request->tariff_code,
            'weight' => $request->weight,
        ];

        $response = $this->baseCRUL->API_POST($CURLOPT_URL, $CURLOPT_CUSTOMREQUEST, $CURLPOST_DATA);

        $data = json_decode($response, TRUE);

        return view('frontend.primary_cost', compact('data', 'grand_total'));
//        return response()->json($data);
    }

    public function wishlist_remove()
    {
        $id = request()->route()->parameter('id');
    }

    public function detail($slug, $id)
    {
        $id = request()->route()->parameter('id');
        $user_id = domain_info('user_id');


        $info = Term::where('user_id', $user_id)->where('type', 'product')->where('status', 1)->with('medias', 'content', 'categories', 'brands', 'seo', 'price', 'options', 'stock')->findorFail($id);
        $next = Term::where('user_id', $user_id)->where('type', 'product')->where('status', 1)->where('id', '>', $id)->first();
        $previous = Term::where('user_id', $user_id)->where('type', 'product')->where('status', 1)->where('id', '<', $id)->first();

        $variations = collect($info->attributes)->groupBy(function ($q) {
            return $q->attribute->name;
        });


        $content = json_decode($info->content->value);
        $seo = json_decode($info->seo->value ?? '');

        SEOMeta::setTitle($seo->meta_title ?? $info->title);
        SEOMeta::setDescription($seo->meta_description ?? $content->excerpt ?? null);
        SEOMeta::addMeta('article:published_time', $info->updated_at->format('Y-m-d'), 'property');
        SEOMeta::addKeyword([$seo->meta_keyword ?? null]);

        OpenGraph::setDescription($seo->meta_description ?? $content->excerpt ?? null);
        OpenGraph::setTitle($seo->meta_title ?? $info->title);
        OpenGraph::addProperty('type', 'product');

        foreach ($info->medias as $row) {
            OpenGraph::addImage(asset($row->url));
            JsonLdMulti::addImage(asset($row->url));
            JsonLd::addImage(asset($row->url));
        }


        JsonLd::setTitle($seo->meta_title ?? $info->title);
        JsonLd::setDescription($seo->meta_description ?? $content->excerpt ?? null);
        JsonLd::setType('Product');

        JsonLdMulti::setTitle($seo->meta_title ?? $info->title);
        JsonLdMulti::setDescription($seo->meta_description ?? $content->excerpt ?? null);
        JsonLdMulti::setType('Product');

        $this->dispatch(new TermStat($pd_id = $id, $status = 'views'));
        return view(base_view() . '.details', compact('info', 'next', 'previous', 'variations', 'content'));
    }

    public function detail_cookie($slug, $id, $id_user, $cookie)
    {
        $id = request()->route()->parameter('id');
        $user_id = domain_info('user_id');


        $info = Term::where('user_id', $user_id)->where('type', 'product')->where('status', 1)->with('medias', 'content', 'categories', 'brands', 'seo', 'price', 'options', 'stock')->findorFail($id);
        $next = Term::where('user_id', $user_id)->where('type', 'product')->where('status', 1)->where('id', '>', $id)->first();
        $previous = Term::where('user_id', $user_id)->where('type', 'product')->where('status', 1)->where('id', '<', $id)->first();

        $variations = collect($info->attributes)->groupBy(function ($q) {
            return $q->attribute->name;
        });


        $content = json_decode($info->content->value);
        $seo = json_decode($info->seo->value ?? '');

        SEOMeta::setTitle($seo->meta_title ?? $info->title);
        SEOMeta::setDescription($seo->meta_description ?? $content->excerpt ?? null);
        SEOMeta::addMeta('article:published_time', $info->updated_at->format('Y-m-d'), 'property');
        SEOMeta::addKeyword([$seo->meta_keyword ?? null]);

        OpenGraph::setDescription($seo->meta_description ?? $content->excerpt ?? null);
        OpenGraph::setTitle($seo->meta_title ?? $info->title);
        OpenGraph::addProperty('type', 'product');

        foreach ($info->medias as $row) {
            OpenGraph::addImage(asset($row->url));
            JsonLdMulti::addImage(asset($row->url));
            JsonLd::addImage(asset($row->url));
        }


        JsonLd::setTitle($seo->meta_title ?? $info->title);
        JsonLd::setDescription($seo->meta_description ?? $content->excerpt ?? null);
        JsonLd::setType('Product');

        JsonLdMulti::setTitle($seo->meta_title ?? $info->title);
        JsonLdMulti::setDescription($seo->meta_description ?? $content->excerpt ?? null);
        JsonLdMulti::setType('Product');
        if (Auth::guard('customer')->check()) {
            $afiliasi = Crypt::decryptString($cookie);
            $get_user_afiliasi = DB::table('customers')->where('id', $afiliasi)->first();
            Cookie::queue('affiliate', $get_user_afiliasi->name, 60);
            Cookie::queue('product_aff', $id, 60);
            Cookie::queue('seller_id', $user_id, 60);
        }
        return view(base_view() . '.details', compact('info', 'next', 'previous', 'variations', 'content'));

    }

    public function category($id)
    {
        $id = request()->route()->parameter('id');
        $user_id = domain_info('user_id');
        $info = Category::where('user_id', $user_id)->where('type', 'category')->with('preview')->findorFail($id);

        if (Cache::has(domain_info('user_id') . 'seo')) {
            $seo = json_decode(Cache::get(domain_info('user_id') . 'seo'));
        } else {
            $data = Useroption::where('user_id', domain_info('user_id'))->where('key', 'seo')->first();
            $seo = json_decode($data->value ?? '');
        }

        JsonLdMulti::setTitle($info->name ?? env('APP_NAME'));
        JsonLdMulti::setDescription($seo->description ?? null);
        JsonLdMulti::addImage(asset($info->preview->content ?? 'uploads/' . domain_info('user_id') . '/logo.png'));

        SEOMeta::setTitle($info->name ?? env('APP_NAME'));
        SEOMeta::setDescription($seo->description ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle($info->name ?? env('APP_NAME'));
        SEOTools::setDescription($seo->description ?? null);
        SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
        SEOTools::opengraph()->addProperty('image', asset($info->preview->content ?? 'uploads/' . domain_info('user_id') . '/logo.png'));
        SEOTools::twitter()->setTitle($info->name ?? env('APP_NAME'));
        SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
        SEOTools::jsonLd()->addImage(asset($info->preview->content ?? 'uploads/' . domain_info('user_id') . '/logo.png'));


        return view(base_view() . '.shop', compact('info'));
    }


    public function home_page_products(Request $request)
    {
        if ($request->latest_product) {
            if ($request->latest_product == 1) {
                $data['get_latest_products'] = $this->get_latest_products();
            } else {
                $data['get_latest_products'] = $this->get_latest_products($request->latest_product);
            }
        }

        if ($request->random_product) {
            if ($request->random_product == 1) {
                $data['get_random_products'] = $this->get_random_products();
            } else {
                $data['get_random_products'] = $this->get_random_products($request->random_product);
            }

        }
        if ($request->get_offerable_products) {
            if ($request->get_offerable_products == 1) {
                $data['get_offerable_products'] = $this->get_offerable_products();
            } else {
                $data['get_offerable_products'] = $this->get_offerable_products($request->random_product);
            }

        }

        if ($request->trending_products) {
            if ($request->trending_products == 1) {
                $data['get_trending_products'] = $this->get_trending_products();
            } else {
                $data['get_trending_products'] = $this->get_trending_products($request->trending_products);
            }

        }

        if ($request->best_selling_product) {
            if ($request->best_selling_product == 1) {
                $data['get_best_selling_product'] = $this->get_best_selling_product();
            } else {
                $data['get_best_selling_product'] = $this->get_best_selling_product($request->best_selling_product);
            }
        }

        if ($request->sliders) {
            $data['sliders'] = $this->get_slider();
        }

        if ($request->menu_category) {
            $data['get_menu_category'] = $this->get_menu_category();
        }

        if ($request->bump_adds) {
            $data['bump_adds'] = $this->get_bump_adds();
        }

        if ($request->banner_adds) {
            $data['banner_adds'] = $this->get_banner_adds();
        }

        if ($request->featured_category) {
            $data['featured_category'] = $this->get_featured_category();
        }

        if ($request->featured_brand) {
            $data['featured_brand'] = $this->get_featured_brand();
        }

        if ($request->category_with_product) {
            $data['category_with_product'] = $this->get_category_with_product();
        }

        if ($request->brand_with_product) {
            $data['brand_with_product'] = $this->get_brand_with_product();
        }


        return response()->json($data);

    }

    public function get_latest_products($limit = 20)
    {
        $user_id = domain_info('user_id');
        $posts = Term::where('user_id', $user_id)->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->withCount('reviews')->latest()->take($limit)->get();
        return $posts;

    }

    public function get_random_products($limit = 20)
    {
        $limit = request()->route()->parameter('limit') ?? 20;
        $user_id = domain_info('user_id');
        $posts = Term::where('user_id', $user_id)->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->withCount('reviews')->inRandomOrder()->take($limit)->get();
        return $posts;
    }

    public function get_offerable_products($limit = 20)
    {
        $user_id = domain_info('user_id');
        $posts = Term::where('user_id', $user_id)->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->whereHas('price', function ($q) {
            return $q->where('ending_date', '>=', date('Y-m-d'))->where('starting_date', '<=', date('Y-m-d'));
        })->withCount('reviews')->inRandomOrder()->take(20)->get();
        return $posts;
    }

    public function get_trending_products($limit = 20)
    {
        $user_id = domain_info('user_id');
        $posts = Term::where('user_id', $user_id)->where('status', 1)->where('type', 'product')->where('featured', 1)->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->withCount('reviews')->latest()->take($limit)->get();
        return $posts;
    }

    public function get_best_selling_product($limit = 20)
    {
        $user_id = domain_info('user_id');
        $posts = Term::where('user_id', $user_id)->where('status', 1)->where('type', 'product')->where('featured', 2)->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->withCount('reviews')->latest()->take($limit)->get();
        return $posts;
    }

    public function get_slider()
    {
        $user_id = domain_info('user_id');
        return Category::where('type', 'slider')->with('excerpt')->where('user_id', $user_id)->latest()->get()->map(function ($q) {
            $data['slider'] = asset($q->name);
            $data['url'] = $q->slug;
            $data['meta'] = json_decode($q->excerpt->content ?? '');

            return $data;
        });
    }

    public function get_menu_category()
    {
        $user_id = domain_info('user_id');
        return $data = Category::where('type', 'category')->where('user_id', $user_id)->where('menu_status', 1)->get()->map(function ($q) {
            $data['id'] = $q->id;
            $data['name'] = $q->name;
            $data['slug'] = $q->slug;
            return $data;
        });
    }

    public function get_bump_adds()
    {
        $user_id = domain_info('user_id');
        return Category::where('user_id', $user_id)->where('type', 'offer_ads')->latest()->get()->map(function ($q) {
            $data['image'] = asset($q->name);
            $data['url'] = $q->slug;
            return $data;
        });

    }

    public function get_banner_adds()
    {
        $user_id = domain_info('user_id');
        return Category::where('user_id', $user_id)->where('type', 'banner_ads')->get()->map(function ($q) {
            $data['image'] = asset($q->name);
            $data['url'] = $q->slug;
            return $data;
        });
    }

    public function get_featured_category()
    {
        $user_id = domain_info('user_id');
        $posts = Category::where('user_id', $user_id)->where('type', 'category')->with('preview')->where('featured', 1)->latest()->get()->map(function ($q) {
            $data['id'] = $q->id;
            $data['name'] = $q->name;
            $data['slug'] = $q->slug;
            $data['type'] = $q->type;
            $data['preview'] = asset($q->preview->content ?? 'uploads/default.png');
            return $data;
        });

        return $posts;
    }

    public function get_featured_brand()
    {
        $user_id = domain_info('user_id');
        $posts = Category::where('user_id', $user_id)->where('type', 'brand')->with('preview')->where('featured', 1)->latest()->get()->map(function ($q) {
            $data['id'] = $q->id;
            $data['name'] = $q->name;
            $data['slug'] = $q->slug;
            $data['type'] = $q->type;
            $data['preview'] = asset($q->preview->content ?? 'uploads/default.png');
            return $data;
        });
        return $posts;
    }

    public function get_category_with_product($limit = 10)
    {
        $limit = request()->route()->parameter('limit');
        $user_id = domain_info('user_id');
        $posts = Category::where('user_id', $user_id)->where('type', 'category')->with('take_20_product')->take($limit)->get();

        return $posts;
    }

    public function get_brand_with_product($limit = 10)
    {

        $limit = request()->route()->parameter('limit');

        $user_id = domain_info('user_id');
        $posts = Category::where('user_id', $user_id)->where('type', 'brand')->with('take_20_product')->take($limit)->get();

        return $posts;
    }

    public function brand($id)
    {
        $id = request()->route()->parameter('id');
        $user_id = domain_info('user_id');
        $info = Category::where('user_id', $user_id)->where('type', 'brand')->with('preview')->findorFail($id);

        if (Cache::has(domain_info('user_id') . 'seo')) {
            $seo = json_decode(Cache::get(domain_info('user_id') . 'seo'));
        } else {
            $data = Useroption::where('user_id', domain_info('user_id'))->where('key', 'seo')->first();
            $seo = json_decode($data->value ?? '');
        }

        JsonLdMulti::setTitle($info->name ?? env('APP_NAME'));
        JsonLdMulti::setDescription($seo->description ?? null);
        JsonLdMulti::addImage(asset($info->preview->content ?? 'uploads/' . domain_info('user_id') . '/logo.png'));

        SEOMeta::setTitle($info->name ?? env('APP_NAME'));
        SEOMeta::setDescription($seo->description ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle($info->name ?? env('APP_NAME'));
        SEOTools::setDescription($seo->description ?? null);
        SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
        SEOTools::opengraph()->addProperty('image', asset($info->preview->content ?? 'uploads/' . domain_info('user_id') . '/logo.png'));
        SEOTools::twitter()->setTitle($info->name ?? env('APP_NAME'));
        SEOTools::twitter()->setSite($info->name ?? null);
        SEOTools::jsonLd()->addImage(asset($info->preview->content ?? 'uploads/' . domain_info('user_id') . '/logo.png'));

        return view(base_view() . '.shop', compact('info'));

    }

    public function get_ralated_product_with_latest_post(Request $request)
    {
        $user_id = domain_info('user_id');

        $this->cats = $request->categories ?? [];
        $avg = Review::where('term_id', $request->term)->avg('rating');
        $ratting_count = Review::where('term_id', $request->term)->count();
        $avg = (int)$avg;
        $related = Term::where('user_id', $user_id)->where('status', 1)->where('type', 'product')->whereHas('post_categories', function ($q) {
            $q->whereIn('category_id', $this->cats);
        })->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->withCount('reviews')->latest()->take(20)->get();

        $get_latest_products = $this->get_latest_products();
        $data['get_latest_products'] = $get_latest_products;
        $data['get_related_products'] = $related;
        $data['ratting_count'] = $ratting_count;
        $data['ratting_avg'] = $avg;

        return response()->json($data);
    }

    public function get_reviews($id)
    {
        $user_id = domain_info('user_id');
        $id = request()->route()->parameter('id');
        $reviews = Review::where('term_id', $id)->where('user_id', $user_id)->latest()->paginate(12);
        $data = [];
        foreach ($reviews as $review) {
            $dta['rating'] = $review->rating;
            $dta['name'] = $review->name;
            $dta['comment'] = $review->comment;
            $dta['created_at'] = $review->created_at->diffForHumans();
            array_push($data, $dta);
        }
        $revi['data'] = $data;
        $revi['links'] = $reviews;

        return response()->json($revi);
    }

    public function get_ralated_products(Request $request)
    {
        $user_id = domain_info('user_id');

        $this->cats = $request->cats;

        $posts = Term::where('user_id', $user_id)->where('status', 1)->where('type', 'product')->whereHas('post_categories', function ($q) {
            $q->whereIn('category_id', $this->cats);
        })->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->latest()->paginate(30);

        return response()->json($posts);
    }

    public function product_search(Request $request)
    {
        $user_id = domain_info('user_id');
        $posts = Term::where('user_id', $user_id)->where('status', 1)->where('type', 'product')->where('title', 'LIKE', '%' . $request->src . '%')->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->latest()->paginate(30);
        return response()->json($posts);
    }

    public function get_products(Request $request)
    {
        $user_id = domain_info('user_id');
        $posts = Term::where('user_id', $user_id)->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->withCount('reviews')->latest()->paginate(30);
        return response()->json($posts);
    }

    public function max_price()
    {
        $user_id = domain_info('user_id');
        return Attribute::where('user_id', $user_id)->max('price');

    }

    public function min_price()
    {
        $user_id = domain_info('user_id');
        return Attribute::where('user_id', $user_id)->min('price');

    }

    public function get_shop_attributes()
    {
        $data['categories'] = $this->get_category();
        $data['brands'] = $this->get_brand();
        $data['attributes'] = $this->get_featured_attributes();
        return $data;
    }

    public function get_category()
    {
        $user_id = domain_info('user_id');
        return $posts = Category::where('user_id', $user_id)->where('type', 'category')->withCount('posts')->latest()->get();


    }

    public function get_brand()
    {
        $user_id = domain_info('user_id');
        return $posts = Category::where('user_id', $user_id)->where('type', 'brand')->withCount('posts')->latest()->get();


    }

    public function get_featured_attributes()
    {
        $user_id = domain_info('user_id');
        $posts = Category::where('user_id', $user_id)->where('type', 'parent_attribute')->where('featured', 1)->with('featured_child_with_post_count_attribute')->get();

        return $posts;
    }

    public function get_shop_products(Request $request)
    {

        if ($request->order == 'DESC' || $request->order == 'ASC') {
            $order = $request->order;
        } else {
            $order = 'DESC';
        }
        if ($request->order == 'bast_sell') {
            $featured = 2;
        } elseif ($request->order == 'trending') {
            $featured = 1;
        } else {
            $featured = 0;
        }

        $user_id = domain_info('user_id');
        $this->attrs = $request->attrs ?? [];
        $this->cats = $request->categories ?? [];

        $posts = Term::where('user_id', $user_id)->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->withCount('reviews');

        if (!empty($request->term)) {
            $data = $posts->where('title', 'LIKE', '%' . $request->term . '%');
        }

        if (count($this->attrs) > 0) {
            $data = $posts->whereHas('attributes_relation', function ($q) {
                return $q->whereIn('variation_id', $this->attrs);
            });
        }

        if (!empty($request->min_price)) {
            $min_price = $request->min_price;
            $data = $posts->whereHas('price', function ($q) use ($min_price) {
                return $q->where('price', '>=', $min_price);
            });

        }

        if (!empty($request->max_price)) {
            $max_price = $request->max_price;
            $data = $posts->whereHas('price', function ($q) use ($max_price) {
                return $q->where('price', '<=', $max_price);
            });
        }

        if (count($this->cats) > 0) {
            $data = $posts->whereHas('post_categories', function ($q) {
                return $q->whereIn('category_id', $this->cats);
            });
        }

        if ($featured != 0) {
            $data = $posts->orderBy('featured', 'DESC');
        } else {
            $data = $posts->orderBy('id', $order);
        }

        $data = $data ?? $posts;
        $data = $data->paginate($request->limit ?? 18);
        return response()->json($data);

    }
}
