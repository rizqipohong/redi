<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Option;
use App\Category;
use App\Domain;
use App\Getway;
use App\Plan;
use App\Trasection;
use App\Term;
use App\Models\User;
use App\Models\Userplan;
use Auth;
use Hash;
use App\Helper\Subscription\Paypal;
use App\Helper\Subscription\Toyyibpay;
use App\Helper\Subscription\Instamojo;
use App\Helper\Subscription\Stripe;
use App\Helper\Subscription\Mollie;
use App\Helper\Subscription\Paystack;
use App\Helper\Subscription\Mercado;
use Session;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminContactMail;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;
use App\Models\Userplanmeta;
use Illuminate\Http\Request;
use DB;

class FrontendController extends Controller
{
    public function welcome(Request $request)
    {

        $url = $request->getHost();
        $url = str_replace('www.', '', $url);
        if ($url == env('APP_PROTOCOLESS_URL') || $url == 'localhost') {


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
            $features = Category::where('type', 'features')->with('preview', 'excerpt')->where('is_admin', 1)->latest()->take(6)->get();

            $testimonials = Category::where('type', 'testimonial')->with('excerpt')->where('is_admin', 1)->latest()->get();

            $brands = Category::where('type', 'brand')->with('preview')->where('is_admin', 1)->latest()->get();

            $plans = Plan::where('status', 1)->where('is_default', 0)->latest()->take(3)->get();
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
        return redirect('/check');
    }

    public function check(Request $request)
    {
        $url = $request->getHost();
        $url = str_replace('www.', '', $url);
        if ($url == env('APP_PROTOCOLESS_URL') || $url == 'localhost') {
            return redirect(env('APP_URL'));
        }

        \Helper::domain($url, url('/'));

        return redirect(url('/'));

    }


    public function page($slug)
    {
        $plans = Plan::where('status', 1)->where('is_default', 0)->latest()->take(3)->get();
        $features = Category::where('type', 'features')->with('preview', 'excerpt')->where('is_admin', 1)->latest()->take(6)->get();
        $info = Term::where('slug', $slug)->with('content', 'excerpt')->where('is_admin', 1)->first();
        if (empty($info)) {
            abort(404);
        }
        JsonLdMulti::setTitle($info->title);
        JsonLdMulti::setDescription($info->excerpt->value ?? null);
        JsonLdMulti::addImage(asset('uploads/logo.png'));

        SEOMeta::setTitle($info->title);
        SEOMeta::setDescription($info->excerpt->value ?? null);


        SEOTools::setTitle($info->title);
        SEOTools::setDescription($info->excerpt->value ?? null);


        SEOTools::opengraph()->addProperty('image', asset('uploads/logo.png'));
        SEOTools::twitter()->setTitle($info->title);

        SEOTools::jsonLd()->addImage(asset('uploads/logo.png'));

        return view('page', compact('info', 'plans', 'features'));
    }

    public function service()
    {
        $seo = Option::where('key', 'seo')->first();
        $seo = json_decode($seo->value);
        JsonLdMulti::setTitle('Our Service');
        JsonLdMulti::setDescription($seo->description ?? null);
        JsonLdMulti::addImage(asset('uploads/logo.png'));

        SEOMeta::setTitle('Our Service');
        SEOMeta::setDescription($seo->description ?? null);


        SEOTools::setTitle('Our Service');
        SEOTools::setDescription($seo->description ?? null);


        SEOTools::opengraph()->addProperty('image', asset('uploads/logo.png'));
        SEOTools::twitter()->setTitle('Our Service');

        SEOTools::jsonLd()->addImage(asset('uploads/logo.png'));
        $features = Category::where('type', 'features')->with('preview', 'excerpt')->where('is_admin', 1)->latest()->get();
        return view('service', compact('features'));
    }

    public function priceing()
    {
        $seo = Option::where('key', 'seo')->first();
        $seo = json_decode($seo->value);
        JsonLdMulti::setTitle('Priceing');
        JsonLdMulti::setDescription($seo->description ?? null);
        JsonLdMulti::addImage(asset('uploads/logo.png'));

        SEOMeta::setTitle('Priceing');
        SEOMeta::setDescription($seo->description ?? null);


        SEOTools::setTitle('Priceing');
        SEOTools::setDescription($seo->description ?? null);


        SEOTools::opengraph()->addProperty('image', asset('uploads/logo.png'));
        SEOTools::twitter()->setTitle('Priceing');

        SEOTools::jsonLd()->addImage(asset('uploads/logo.png'));

        $plans = Plan::where('status', 1)->where('is_default', 0)->get();

        return view('priceing', compact('plans'));
    }


    public function contact()
    {
        $seo = Option::where('key', 'seo')->first();
        $seo = json_decode($seo->value);

        JsonLdMulti::setTitle('Contact Us');
        JsonLdMulti::setDescription($seo->description ?? null);
        JsonLdMulti::addImage(asset('uploads/logo.png'));

        SEOMeta::setTitle('Contact Us');
        SEOMeta::setDescription($seo->description ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle('Contact Us');
        SEOTools::setDescription($seo->description ?? null);
        SEOTools::setCanonical($seo->canonical ?? url('/'));
        SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
        SEOTools::opengraph()->addProperty('image', asset('uploads/logo.png'));
        SEOTools::twitter()->setTitle('Contact Us');
        SEOTools::twitter()->setSite('Contact Us');
        SEOTools::jsonLd()->addImage(asset('uploads/logo.png'));
        return view('contact');
    }

    public function send_mail(Request $request)
    {
        if (env('NOCAPTCHA_SITEKEY') != null) {
            $messages = [
                'g-recaptcha-response.required' => 'You must check the reCAPTCHA.',
                'g-recaptcha-response.captcha' => 'Captcha error! try again later or contact site admin.',
            ];

            $validator = \Validator::make($request->all(), [
                'g-recaptcha-response' => 'required|captcha'
            ], $messages);

            if ($validator->fails()) {
                $msg['errors']['domain'] = $validator->errors()->all()[0];
                return response()->json($msg, 422);

            }
        }
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'message' => 'required|max:300',
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];
        Mail::to(env('MAIL_TO'))->send(new AdminContactMail($data));

        return response()->json('Your message submitted successfully !!');
    }


    public function register_view($id)
    {
        $info = Plan::where('status', 1)->findorFail($id);
        return view('marchant.register', compact('info'));
    }

    public function register_affiliate($id, $reff_id)
    {
        $info = Plan::where('status', 1)->findorFail($id);
        return view('marchant.register', compact('info', 'reff_id'));
    }

    public function translate(Request $request)
    {
        Session::put('locale', $request->local);
        \App::setlocale($request->local);
        return redirect('/');
    }


    public function register(Request $request, $id, $link = false)
    {

        if (env('NOCAPTCHA_SITEKEY') != null) {
            $messages = [
                'g-recaptcha-response.required' => 'You must check the reCAPTCHA.',
                'g-recaptcha-response.captcha' => 'Captcha error! try again later or contact site admin.',
            ];

            $validator = \Validator::make($request->all(), [
                'g-recaptcha-response' => 'required|captcha'
            ], $messages);

            if ($validator->fails()) {
                $msg['errors']['domain'] = $validator->errors()->all()[0];
                return response()->json($msg, 422);

            }
        }

        \Validator::extend('without_spaces', function ($attr, $value) {
            return preg_match('/^\S*$/u', $value);
        });

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users|email|max:255',
            'password' => 'required|min:8|confirmed|string',
            'domain' => 'required|max:50|without_spaces|string',
        ]);

        if ($request->has('link')) {
            $emails = [$request->email];
            foreach ($request->link as $link) {
                $emails[] = $link->email;
            }
            $user = User::whereIn('email', $emails)->first();
            if (isset($user->id) && !empty($user->id)) {
                $msg['errors']['domain'] = "Sorry User Already Registered";
                $msg['success'] = 0;
                $msg['msg'] = $msg['errors']['domain'];
                $msg['error'] = 'userRegistered';
                return response()->json($msg, 422);
            }
        }

        $info = Plan::where('status', 1)->findorFail($id);
        if ($info->custom_domain == 0) {
            $domain = strtolower($request->domain) . '.' . env('APP_PROTOCOLESS_URL');
            $input = trim($domain, '/');
            if (!preg_match('#^http(s)?://#', $input)) {
                $input = 'http://' . $input;
            }
            $urlParts = parse_url($input);
            $domain = preg_replace('/^www\./', '', $urlParts['host']);
            $full_domain = env('APP_PROTOCOL') . $domain;
        } else {
            $validatedData = $request->validate([
                'full_domain' => 'required|string|max:50',
            ]);
            $domain = strtolower($request->domain);
            $input = trim($domain, '/');
            if (!preg_match('#^http(s)?://#', $input)) {
                $input = 'http://' . $input;
            }
            $urlParts = parse_url($input);
            $domain = preg_replace('/^www\./', '', $urlParts['host']);

            $full_domain = rtrim($request->full_domain, '/');
        }

        $check_fulldomain = Domain::where('full_domain', $full_domain)->first();

        $check = Domain::where('domain', $domain)->first();
        if (!empty($check)) {
            $msg['errors']['domain'] = "Sorry Domain Name Already Exists";
            $msg['success'] = 0;
            $msg['msg'] = $msg['errors']['domain'];
            $msg['error'] = 'domainInUse';
            return response()->json($msg, 422);
        }

        if (!empty($check_fulldomain)) {
            $msg['errors']['domain'] = "Sorry Domain Name Already Exists";
            $msg['success'] = 0;
            $msg['msg'] = $msg['errors']['domain'];
            $msg['error'] = 'domainInUse';
            return response()->json($msg, 422);
        }

        DB::beginTransaction();
        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = 3;
            $user->status = 3;
            $user->save();

            $dom = new Domain;
            $dom->domain = $domain;
            $dom->full_domain = $full_domain;
            $dom->status = 3;
            $dom->user_id = $user->id;
            $dom->save();

            $user = User::find($user->id);
            $user->domain_id = $dom->id;
            $user->save();


            if (Auth::check()) {
                Auth::logout();
            }
            Auth::loginUsingId($user->id);
            $auto = true;
            if ($info->price == 0) {
                $auto_order = Option::where('key', 'auto_order')->first();
                if ($auto_order->value == 'yes') {
                    $plan = $info;
                    $auto = true;
                }

                $auto = false;

            } else {
                $plan = Plan::where('is_default', 1)->first();
                $auto = false;
            }
            if($request->reff_id){
                $aff = new Affiliate;
                $aff->user_id = $request->reff_id;
                $aff->member_id = $user->id;
                $aff->plan_id = 1;
                $aff->link = $request->url;
                $aff->save();
            }
            $userplan = new Userplanmeta;
            $userplan->user_id = Auth::id();
            if (!empty($plan)) {
                $userplan->name = $plan->name;
                $userplan->product_limit = $plan->product_limit;
                $userplan->storage = $plan->storage;
                $userplan->customer_limit = $plan->customer_limit;
                $userplan->category_limit = $plan->category_limit;
                $userplan->location_limit = $plan->location_limit;
                $userplan->brand_limit = $plan->brand_limit;
                $userplan->variation_limit = $plan->variation_limit;
            } else {
                $userplan->name = 'free';
                $userplan->storage = 0;
            }
            $userplan->save();

            if ($info->price == 0 || $info->price == 0.00) {
                $exp_days = $info->days;
                $expiry_date = \Carbon\Carbon::now()->addDays(($exp_days - 1))->format('Y-m-d');

                $max_order = Userplan::max('id');
                $order_prefix = Option::where('key', 'order_prefix')->first();


                $order_no = $order_prefix->value . $max_order;

                $transection = new Trasection;
                $transection->category_id = 2;
                $transection->user_id = Auth::id();
                $transection->trasection_id = \Str::random(10);
                $transection->status = 1;
                $transection->save();

                $userplan = new Userplan;
                $userplan->order_no = $order_no;
                $userplan->amount = $info->price;
                $userplan->user_id = Auth::id();
                $userplan->plan_id = $info->id;
                $userplan->trasection_id = $transection->id ?? null;
                $userplan->will_expired = $expiry_date;


                if ($auto == true) {
                    $userplan->status = 1;
                }
                $userplan->save();

                Session::flash('success', 'Thank You For Subscribe After Review The Order You Will Get A Notification Mail From Admin');


            } else {

                if (!empty($plan)) {
                    if ($plan->is_default == 1) {
                        $exp_days = $plan->days ?? 5;
                        $expiry_date = \Carbon\Carbon::now()->addDays(($exp_days - 1))->format('Y-m-d');

                        $max_order = Userplan::max('id');
                        $order_prefix = Option::where('key', 'order_prefix')->first();


                        $order_no = $order_prefix->value . $max_order;

                        $userplan = new Userplan;
                        $userplan->order_no = $order_no;
                        $userplan->amount = $plan->price;
                        $userplan->user_id = Auth::id();
                        $userplan->plan_id = $plan->id;
                        $userplan->trasection_id = null;
                        $userplan->will_expired = $expiry_date;

                        $auto_order = Option::where('key', 'auto_order')->first();
                        if ($auto == true) {
                            $userplan->status = 1;
                        }
                        $userplan->save();
                    }
                }


            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        if ($link) {
            $userplan->status = 1;
            $userplan->save();

            $user->status = 1;
            $user->save();

            $dom->status = 1;
            $dom->save();

            $gw = new Getway;
            $gw->content = json_encode(["title" => "Ratapay", "description" => "Pay via Ratapay", "currency" => "IDR", "key_id" => $request->merchant_id, "key_secret" => $request->merchant_secret]);
            $gw->user_id = $user->id;
            $gw->category_id = 94;
            $gw->status = 1;
            $gw->save();

            $key = bin2hex(random_bytes(50));
            cache([$key => $user->id], now()->addMinutes(5));
            return response()->json(['success' => 1, 'link' => $dom->full_domain . '/login-link/' . $key]);
        } else {
            return response()->json(['Successfully Registered']);
        }

    }


    public function dashboard()
    {
        return view('seller.dashboard');
    }

    public function settings()
    {
        return view('seller.settings');
    }


    public function make_payment($id)
    {
        if (Session::has('success')) {
            Session::flash('success', 'Thank You For Subscribe After Review The Order You Will Get A Notification Mail From Admin');
            return redirect('merchant/plan');
        }
        $info = Plan::where('status', 1)->where('is_default', 0)->where('price', '>', 0)->findorFail($id);
        $getways = Category::where('type', 'payment_getway')->where('featured', 1)->where('slug', '!=', 'cod')->with('preview')->get();
        $currency = \App\Option::where('key', 'currency_info')->first();
        $currency = json_decode($currency->value);
        $currency_name = $currency->currency_name;
        $price = $currency_name . ' ' . $info->price;
        return view('seller.plan.payment', compact('info', 'getways', 'price'));
    }

    public function make_charge(Request $request, $id)
    {

        $info = Plan::where('status', 1)->where('is_default', 0)->where('price', '>', 0)->findorFail($id);
        $getway = Category::where('type', 'payment_getway')->where('featured', 1)->where('slug', '!=', 'cod')->findorFail($request->mode);

        $currency = \App\Option::where('key', 'currency_info')->first();
        $currency = json_decode($currency->value);
        $currency_name = $currency->currency_name;
        $total = $info->price;

        $data['ref_id'] = $id;
        $data['getway_id'] = $request->mode;
        $data['amount'] = $total;
        $data['email'] = Auth::user()->email;
        $data['name'] = Auth::user()->name;
        $data['phone'] = $request->phone;
        $data['billName'] = $info->name;
        $data['currency'] = strtoupper($currency_name);
        Session::put('order_info', $data);
        if ($getway->slug == 'paypal') {
            return Paypal::make_payment($data);
        }
        if ($getway->slug == 'instamojo') {
            return Instamojo::make_payment($data);
        }
        if ($getway->slug == 'toyyibpay') {
            return Toyyibpay::make_payment($data);
        }
        if ($getway->slug == 'stripe') {
            $data['stripeToken'] = $request->stripeToken;
            return Stripe::make_payment($data);
        }
        if ($getway->slug == 'mollie') {
            return Mollie::make_payment($data);
        }
        if ($getway->slug == 'paystack') {
            return Paystack::make_payment($data);
        }
        if ($getway->slug == 'mercado') {
            return Mercado::make_payment($data);
        }

        if ($getway->slug == 'razorpay') {
            return redirect('/merchant/payment-with/razorpay');
        }


    }

    public function success()
    {
        if (Session::has('payment_info')) {
            $data = Session::get('payment_info');
            $plan = Plan::findorFail($data['ref_id']);

            DB::beginTransaction();
            try {
                $transection = new Trasection;
                $transection->category_id = $data['getway_id'];
                $transection->trasection_id = $data['payment_id'];
                if (isset($data['payment_status'])) {
                    $transection->status = $data['payment_status'];
                } else {
                    $transection->status = 1;
                }
                $transection->save();

                $exp_days = $plan->days;
                $expiry_date = \Carbon\Carbon::now()->addDays(($exp_days - 1))->format('Y-m-d');

                $max_order = Userplan::max('id');
                $order_prefix = Option::where('key', 'order_prefix')->first();


                $order_no = $order_prefix->value . $max_order;

                $user = new Userplan;
                $user->order_no = $order_no;
                $user->amount = $data['amount'];
                $user->user_id = Auth::id();
                $user->plan_id = $plan->id;
                $user->trasection_id = $transection->id;
                $user->will_expired = $expiry_date;

                $auto_order = Option::where('key', 'auto_order')->first();
                if ($auto_order->value == 'yes' && $transection->status == 1) {
                    $user->status = 1;
                }

                $user->save();

                if ($auto_order->value == 'yes' && $transection->status == 1) {
                    $meta = Userplanmeta::where('user_id', Auth::id())->first();
                    if (empty($meta)) {
                        $meta = new Userplanmeta;
                        $meta->user_id = Auth::id();
                    }
                    $meta->name = $plan->name;
                    $meta->product_limit = $plan->product_limit;
                    $meta->storage = $plan->storage;
                    $meta->customer_limit = $plan->customer_limit;
                    $meta->category_limit = $plan->category_limit;
                    $meta->location_limit = $plan->location_limit;
                    $meta->brand_limit = $plan->brand_limit;
                    $meta->variation_limit = $plan->variation_limit;
                    $meta->save();
                }

                Session::flash('success', 'Thank You For Subscribe After Review The Order You Will Get A Notification Mail From Admin');


                $data['info'] = $user;
                $data['to_admin'] = env('MAIL_TO');
                $data['from_email'] = Auth::user()->email;

                try {
                    if (env('QUEUE_MAIL') == 'on') {
                        dispatch(new \App\Jobs\SendInvoiceEmail($data));
                    } else {
                        \Mail::to(env('MAIL_TO'))->send(new OrderMail($data));
                    }
                } catch (Exception $e) {

                }

                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
            }

            return redirect('merchant/plan');
        }
        abort(404);
    }

    public function fail()
    {
        Session::forget('payment_info');
        Session::flash('fail', 'Transection Failed');
        return redirect('merchant/plan');
    }

    public function plans()
    {
        $posts = Plan::where('status', 1)->where('is_default', 0)->where('price', '>', 0)->get();
        return view('seller.plan.index', compact('posts'));
    }


}