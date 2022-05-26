<?php

namespace App\Http\Controllers\Auth;

use App\Domain;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Userplan;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  //protected $redirectTo = RouteServiceProvider::HOME;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function redirectTo()
  {
    if (Auth::user()->role_id == 1) {
      if (url('/') != env('APP_URL')) {
        Auth::logout();
        $this->redirectTo = env('APP_URL') . '/login';
        return $this->redirectTo;
      } else {
        $this->redirectTo = env('APP_URL') . '/admin/dashboard';
        return $this->redirectTo;
      }
    } elseif (Auth::user()->role_id == 2) {
      $url = Auth::user()->user_domain->full_domain;

      if (str_replace('www.', '', url('/')) != $url) {
        Auth::logout();
        return $this->redirectTo = $url . '/user/login';
      } else {
        return  $this->redirectTo = $url . '/user/dashboard';
      }
    } elseif (Auth::user()->role_id == 3) {
      $url = Auth::user()->user_domain->full_domain;
      if (Auth::user()->status == 3) {
        $this->redirectTo = env('APP_URL') . '/merchant/dashboard';
        return $this->redirectTo;
      } elseif (Auth::user()->status === 0 || Auth::user()->status == 2) {
        $this->redirectTo = env('APP_URL') . '/suspended';
        return $this->redirectTo;
      } elseif (url('/') != $url && Auth::user()->status != 3) {
        Auth::logout();
        return  $this->redirectTo = $url . '/login';
      } else {
        if (url('/') != $url) {
          Auth::logout();
          return  $this->redirectTo = $url . '/login';
        }
        return $this->redirectTo = $url . '/seller/dashboard';
      }
    }
    $this->middleware('guest')->except('logout');
  }

  public function loginFromApp(Request $request)
  {
    $user = User::where('email', $request->email)->first();
    if (empty($user->id)) {
      if ($request->has('link')) {
        $emails = [];
        foreach ($request->link as $link) {
          $emails[] = $link->email;
        }
        if (count($emails) > 0) {
          $user = User::whereIn('email', $emails)->first();
        }
      }
      if (empty($user->id)) {
        return response()->json(['success' => 0, 'msg' => 'User Not Registered', 'error' => 'notRegistered']);
      }
    } else {
      $key = bin2hex(random_bytes(50));
      cache([$key => $user->id], now()->addMinutes(5));
      $dom = Domain::where('user_id', $user->id)->first();
      return response()->json(['success' => 1, 'link' => $dom->full_domain . '/login-link/'. $key]);
    }
  }

  public function loginLink(Request $request, $key = '')
  {
    if (empty($key)) return redirect(url('/'));
    $user_id = cache($key, null);
    if (empty($user_id)) return redirect(url('/'));
    else {
      Auth::loginUsingId($user_id);
      Cache::forget($key);
      return redirect(route('seller.dashboard'));
    }
  }
}
