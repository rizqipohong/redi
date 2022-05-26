<?php

namespace App\Http\Controllers\Frontend;

use App\Domain;
use App\Http\Controllers\Controller;
use App\Models\AccountRatapay;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Userplanmeta;
use App\Models\Customer;
use Hash;
use App\Order;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Cache;
use App\Useroption;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;
use Response;
use Kavist\RajaOngkir\Facades\RajaOngkir;


class UserController extends Controller
{
    public function __construct()
    {
        if (env('MULTILEVEL_CUSTOMER_REGISTER') != true || url('/') == env('APP_URL')) {
            abort(404);
        }
    }

    public function become_seller()
    {
        return view('frontend.arafa-cart.account.become_seller');
    }

    public function become_seller_post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'website' => 'required|max:255',
        ]);

        if ($validator->passes()) {
            $id_user = Auth::guard('customer')->user()->id;
            $domain = strtolower($request->website) . '.' . env('APP_PROTOCOLESS_URL');
            $checkDomain = Domain::where('domain', $domain)->first();
            $getCust = Customer::where('id', $id_user)->first();
            if ($checkDomain === null) {
                Customer::where('id', $id_user)->update(['role_id' => 3]);
                Customer::query()
                    ->where('id', $id_user)
                    ->each(function ($oldPost) {
                        $newPost = $oldPost->replicate();
                        $newPost->setTable('users');
                        $newPost->save();
                    });
                $domain_user_id =  User::where('email', $getCust->email)->first();
                Domain::create([
                    'domain' => $domain,
                    'full_domain' => 'http://' . $domain,
                    'status' => 1,
                    'user_id' => $domain_user_id->id,
                    'template' => 2,
                    'shop_type' => 1,
                ]);
            }else{
                return Response::json(['errors' => 'Website Is Owned']);
            }
            return Response::json(['success' => '1']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    public function address_create(Request $request)
    {
        $id = Auth::guard('customer')->user()->id;
        try {
            $check = DB::table('useraddress')->where('customer_id', $id)->get();
            $status = 0;
            if (empty($check)) {
                $status = 1;
            }
            DB::table('useraddress')->insert([
                'customer_id' => $id,
                'address_id' => $request->city,
                'recipient' => $request->recipient,
                'phonenumber' => $request->phonenumber,
                'detail' => $request->detail,
                'status' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->back();
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function address_update($id, Request $request)
    {
//        $id = Auth::guard('customer')->user()->id;
        try {
            $check = DB::table('useraddress')->where('customer_id', $id)->get();
            $status = 0;
            if (empty($check)) {
                $status = 1;
            }
            DB::table('useraddress')->where('id', $id)
                ->update([
                    'address_id' => $request->location,
                    'recipient' => $request->recipient,
                    'phonenumber' => $request->phonenumber,
                    'detail' => $request->detail,
                    'status' => $status,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            return redirect()->back();
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function address_edit($id)
    {
//        $id = Auth::guard('customer')->user()->id;
        try {
            $destination = DB::table('destination')->groupBy('province')->get();
            $data = DB::table('useraddress')->where('id', $id)
                ->first();
            return view(base_view() . '.account.address_edit', compact('data', 'destination'));

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function address_primary($id)
    {
        try {
            $data = DB::table('useraddress')->where('customer_id', Auth::guard('customer')->user()->id)->update(['status' => 0]);
            DB::table('useraddress')->where('id', $id)->update(['status' => 1]);
            return redirect()->back();
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function address_delete(Request $request)
    {
//        $id = Auth::guard('customer')->user()->id;
        try {
            $data = DB::table('useraddress')->where('id', $request->id)->delete();
            return redirect()->back();
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function address()
    {
        if (Auth::guard('customer')->check()) {
            SEOTools::setTitle('Address Customer');
            try {
                $id = Auth::guard('customer')->user()->id;
                $destination = DB::table('destination')->groupBy('province')->get();
                $data_address = DB::table('useraddress')->where('customer_id', $id)->get();
                $daftarProvinsi = RajaOngkir::provinsi()->all();
                $daftarKota = RajaOngkir::kota()->all();

                return view(base_view() . '.account.address',
                    compact('destination', 'data_address', 'daftarProvinsi', 'daftarKota'));
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
        return redirect('/user/login');
    }

    public function chat()
    {
        if (Auth::guard('customer')->check()) {
            SEOTools::setTitle('Chat Seller');
            try {
                $chat_customer = DB::table('chats')->where('customer_id', Auth::guard('customer')->user()->id)
                    ->orderBy('created_at')->get();
                $products = DB::table('orders')
                    ->join('orderitems', 'orders.id', 'orderitems.order_id')
                    ->join('terms', 'orderitems.term_id', 'terms.id')
                    ->where('orders.customer_id', Auth::guard('customer')->user()->id)
                    ->select('terms.*')
                    ->get();
                $info = Order::where('customer_id', Auth::guard('customer')->user()->id)->where('user_id', domain_info('user_id'))->with('payment_method')->get();
//                return $products;
                return view(base_view() . '.account.chat', compact('chat_customer', 'info', 'products'));
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
        return redirect('/user/login');
    }

    public function chat_send(Request $request)
    {
        DB::table('chats')
            ->insert([
                'customer_id' => Auth::guard('customer')->user()->id,
                'seller_id' => $request->seller_id,
                'term_id' => $request->term_id,
                'comment' => $request->comment,
                'attach' => $request->attach,
                'status' => 0,
                'role' => 'customer',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        return redirect('/user/chat/seller');

    }

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
        return redirect('/user/dashboard/');
    }

    public function order_cancel(Request $request)
    {
        DB::table('orders')->where('id', $request->order_id)->update([
            'status' => 'canceled'
        ]);
        $check_item_order = DB::table('orders')
            ->join('orderitems', 'orders.id', 'orderitems.order_id')
            ->where('orders.id', $request->order_id)
            ->get();
        foreach ($check_item_order as $item) {
            DB::table('refunditems')
                ->insert([
                    'order_id' => $item->order_id,
                    'term_id' => $item->term_id,
                    'info' => 'No Comment',
                    'status' => 'pending',
                    'qty' => $item->qty,
                    'amount' => $item->amount,
                ]);
        }

        return redirect('/user/dashboard/');
    }

    public function login()
    {

        if (Auth::check() == true) {
            Auth::logout();
        }
        if (Auth::guard('customer')->check() == true) {

            return redirect('/user/dashboard');
        }
        if (Cache::has(domain_info('user_id') . 'seo')) {
            $seo = json_decode(Cache::get(domain_info('user_id') . 'seo'));
        } else {
            $data = Useroption::where('user_id', domain_info('user_id'))->where('key', 'seo')->first();
            $seo = json_decode($data->value ?? '');
        }
        if (!empty($seo)) {
            JsonLdMulti::setTitle('Login - ' . $seo->title ?? env('APP_NAME'));
            JsonLdMulti::setDescription($seo->description ?? null);
            JsonLdMulti::addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));

            SEOMeta::setTitle('Login - ' . $seo->title ?? env('APP_NAME'));
            SEOMeta::setDescription($seo->description ?? null);
            SEOMeta::addKeyword($seo->tags ?? null);

            SEOTools::setTitle('Login - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::setDescription($seo->description ?? null);
            SEOTools::setCanonical($seo->canonical ?? url('/'));
            SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
            SEOTools::opengraph()->addProperty('image', asset('uploads/' . domain_info('user_id') . '/logo.png'));
            SEOTools::twitter()->setTitle('Login - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
            SEOTools::jsonLd()->addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));
        }

        return view(base_view() . '.account.login');
    }

    public function register_seller()
    {

    }

    public function register()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        if (Auth::guard('customer')->check()) {
            return redirect('/user/dashboard');
        }

        if (Cache::has(domain_info('user_id') . 'seo')) {
            $seo = json_decode(Cache::get(domain_info('user_id') . 'seo'));
        } else {
            $data = Useroption::where('user_id', domain_info('user_id'))->where('key', 'seo')->first();
            $seo = json_decode($data->value ?? '');
        }
        if (!empty($seo)) {
            JsonLdMulti::setTitle('Register - ' . $seo->title ?? env('APP_NAME'));
            JsonLdMulti::setDescription($seo->description ?? null);
            JsonLdMulti::addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));

            SEOMeta::setTitle('Register - ' . $seo->title ?? env('APP_NAME'));
            SEOMeta::setDescription($seo->description ?? null);
            SEOMeta::addKeyword($seo->tags ?? null);

            SEOTools::setTitle('Register - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::setDescription($seo->description ?? null);
            SEOTools::setCanonical($seo->canonical ?? url('/'));
            SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
            SEOTools::opengraph()->addProperty('image', asset('uploads/' . domain_info('user_id') . '/logo.png'));
            SEOTools::twitter()->setTitle('Register - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
            SEOTools::jsonLd()->addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));
        }
        return view(base_view() . '.account.register');
    }

    public function settings()
    {
        SEOTools::setTitle('Settings');
        $account = AccountRatapay::where('customer_id', Auth::guard('customer')->user()->id)->first();
        return view(base_view() . '.account.account', compact('account'));
    }

    public function settings_update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:customers,email,' . Auth::guard('customer')->user()->id

        ]);

        if ($request->password) {
            $validatedData = $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }

        $user = Customer::find(Auth::guard('customer')->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $check = Hash::check($request->password_current, auth()->user()->password);
            if ($check == true) {
                $user->password = Hash::make($request->password);
            } else {
                $returnData['errors']['password'] = array(0 => "Enter Valid Password");
                $returnData['message'] = "given data was invalid.";
                return response()->json($returnData, 401);
            }
        }
        $user->save();

        return response()->json(['Profile Updated Successfully']);
    }

    public function orders()
    {
        SEOTools::setTitle('Orders');
        $orders = Order::where('customer_id', Auth::guard('customer')->user()->id)->where('user_id', domain_info('user_id'))->with('payment_method')->latest()->paginate(20);
        return view(base_view() . '.account.orders', compact('orders'));
    }

    public function order_view($id)
    {
        $chat_customer = DB::table('chats')->where('customer_id', Auth::guard('customer')->user()->id)
            ->orderBy('created_at')->get();
        $products = DB::table('orders')
            ->join('orderitems', 'orders.id', 'orderitems.order_id')
            ->join('terms', 'orderitems.term_id', 'terms.id')
            ->where('orders.customer_id', Auth::guard('customer')->user()->id)
            ->select('terms.*')
            ->get();
        $id = request()->route()->parameter('id');
        $info = Order::where('customer_id', Auth::guard('customer')->user()->id)->where('user_id', domain_info('user_id'))->with('order_item_with_file', 'order_content', 'shipping_info', 'payment_method')->findorFail($id);
        $order_content = json_decode($info->order_content->value);
        $reviews = DB::table('reviews')->get();
        SEOTools::setTitle('Order No ' . $info->order_no);
//        return response()->json($info);
        return view(base_view() . '.account.order_view', compact('info', 'order_content', 'reviews', 'chat_customer', 'products'));
    }

    public function register_user(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:100',
            'name' => 'required|max:100',
            'password' => 'required|confirmed|min:8|max:50',
        ]);
        $domain_id = domain_info('domain_id');
        $user_id = domain_info('user_id');

        $plan = Userplanmeta::where('user_id', $user_id)->first();
        $user_limit = $plan->customer_limit ?? 0;
        $total_customers = Customer::where('created_by', $user_id)->count();

        $check = Customer::where([['created_by', $user_id], ['email', $request->email]])->first();
        if (!empty($check)) {
            \Session::flash('user_limit', 'Opps the email address already exists...!!');
            return back();
        }
        $user = new Customer();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->domain_id = $domain_id;
        $user->created_by = $user_id;
        $user->save();
        Auth::guard('customer')->loginUsingId($user->id);

//        post to ratapay
        $postData = [
            'email' => $request->email,
            'name' => $request->name,
            'password' => $request->password,
            'username' => $request->username,
            'complete' => $request->complete,
        ];
        $client = new Client();
        $res = $client->request('POST', env('RATAPAY_GW_API_REGISTER') . '/oauth/token', [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => env('RATAPAY_GW_CLIENT_ID'),
                'client_secret' => env('RATAPAY_GW_CLIENT_SECRET'),
                'Scope' => '*',
            ]
        ]);
        $timestamp = Carbon::now();
        $isoTime = $timestamp->format(DateTime::ATOM);
        $token = (string)$res->getBody();
        $token = json_decode($token, true);
        $url = 'GET:/account?email=' . $postData['email'] . '&name=' . $postData['name'] . '&password=' . $postData['password'] . '&username=' . $postData['username'] . '&complete=' . $postData['complete'];
        $payloadHash = hash('sha256', '');
        $stringToSign = $url . ':' . $token['access_token'] . ':' . $payloadHash . ':' . $isoTime;
        $headerToSign = hash_hmac('sha256', $stringToSign, env('RATAPAY_GW_API_SECRET'));
        try {
            $res = $client->get(env('RATAPAY_GW_API_REGISTER') . '/account?email=' . $postData['email'] . '&name=' . $postData['name'] . '&password=' . $postData['password'] . '&username=' . $postData['username'] . '&complete=' . $postData['complete'], [
                'headers' => [
                    'X-RATAPAY-SIGN' => $headerToSign,
                    'X-RATAPAY-KEY' => env('RATAPAY_GW_API_KEY'),
                    'X-RATAPAY-TS' => $isoTime,
                    'Authorization' => 'Bearer ' . $token['access_token'],
                ],
            ]);
            $resBody = (string)$res->getBody();
            $resBody = json_decode($resBody, true);
            AccountRatapay::create([
                'customer_id' => $user->id,
                'email' => $resBody['account']['email'],
                'name' => $resBody['account']['name'],
                'account_number' => $resBody['account']['account_number'],
                'account_currency' => $resBody['account']['account_currency'],
                'account_last_active' => $resBody['account']['account_last_active'],
                'account_created_time' => $resBody['account']['account_created_time'],
                'account_id' => $resBody['account']['account_id'],
                'account_balance' => $resBody['account']['account_balance'],
                'phone' => $resBody['account']['phone'],
                'account_status' => $resBody['account']['account_status'],
                'link_status' => $resBody['account']['link_status'],
            ]);
            return redirect('/user/dashboard')->with('toast_success', 'Task Created Successfully!');
        } catch (ClientException $exc) {
            throw new Exception($exc->getMessage());
        }

    }

    public function return_item(Request $request)
    {
        DB::table('returnitems')->insert([
            'order_id' => $request->order_id,
            'term_id' => $request->term_id,
            'info' => $request->info,
            'status' => 'Pending',
            'qty' => $request->qty,
            'amount' => $request->amount,
        ]);
        return redirect()->back();
    }

    public function return_proof_item(Request $request)
    {
        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);

        DB::table('returnitems')
            ->where('order_id', $request->order_id)
            ->update([
                'proof' => $new_name
            ]);
        return redirect()->back();
    }

    public function dashboard()
    {
        if (Auth::guard('customer')->check()) {
            SEOTools::setTitle('Dashboard');
            $orders = Order::where('customer_id', Auth::guard('customer')->user()->id)
                ->where('user_id', domain_info('user_id'))->with('payment_method', 'order_content')->latest()->first();
            $order_content = json_decode($orders->order_content->value ?? '');
            if ($orders) {
                if ($orders->status == 'ready-for-pickup') {
                    $lengthOfString = strlen($order_content->estimation);
                    $lastCharPosition = $lengthOfString - 1;
                    $lastChar = ($order_content->estimation[$lastCharPosition] + 2) * 86400;
                    return view(base_view() . '.account.dashboard', compact('orders', 'order_content', 'lastChar'));
                } elseif ($orders->status == 'canceled') {
                    $refund_status = DB::table('refunditems')->where('order_id', $orders->id)->groupBy('order_id')->first();
                    return view(base_view() . '.account.dashboard', compact('orders', 'order_content', 'refund_status'));
                } else {
                    return view(base_view() . '.account.dashboard', compact('orders', 'order_content'));
                }
            } else {
                return view(base_view() . '.account.dashboard', compact('orders', 'order_content'));
            }
        }
        return redirect('/user/login');
    }
}
