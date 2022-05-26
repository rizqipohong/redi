<?php

use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function Clue\StreamFilter\fun;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => 'internalapi'], function () {
    Route::post('login-from-app', 'Auth\LoginController@loginFromApp');
    Route::post('register-from-app/{id}/{link}', 'FrontendController@register');
});
Route::name('api.')->namespace('Api')->group(function () {
    Route::post('jne', 'JNE@price')->name('jne.price');
    Route::post('register', 'Register@postTransaction')->name('register');
    Route::post('detail', 'Register@getDetailAccount')->name('detail');
});

