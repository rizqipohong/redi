<?php
/**
 * Copyright (c) 2022.
 * Dinokhan
 * 3/29/22, 1:33 PM
 */

namespace App\Http\Controllers\Api;

use App\Helper\Order\Ratapay;
use App\Http\Controllers\Api\Traits\BaseCRUL;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DateTime;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class Register extends Controller
{
    public static function postTransaction(Request $request)
    {
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
            $res = $client->get(env('RATAPAY_GW_API_REGISTER').'/account?email=' . $postData['email'] . '&name=' . $postData['name'] . '&password=' . $postData['password'] . '&username=' . $postData['username'] . '&complete=' . $postData['complete'], [
                'headers' => [
                    'X-RATAPAY-SIGN' => $headerToSign,
                    'X-RATAPAY-KEY' => env('RATAPAY_GW_API_KEY'),
                    'X-RATAPAY-TS' => $isoTime,
                    'Authorization' => 'Bearer ' . $token['access_token'],
                ],
            ]);
            $resBody = (string)$res->getBody();
            $resBody = json_decode($resBody, true);
            return $resBody;
        } catch (ClientException $exc) {
            throw new Exception($exc->getMessage());
        }
    }
    public static function getDetailAccount(Request $request)
    {
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
        $url = 'GET:/account?complete=' . $postData['complete'];
        $payloadHash = hash('sha256', '');
        $stringToSign = $url . ':' . $token['access_token'] . ':' . $payloadHash . ':' . $isoTime;
        $headerToSign = hash_hmac('sha256', $stringToSign, env('RATAPAY_GW_API_SECRET'));
        try {
            $res = $client->get(env('RATAPAY_GW_API_REGISTER').'/account?complete=' . $postData['complete'], [
                'headers' => [
                    'X-RATAPAY-SIGN' => $headerToSign,
                    'X-RATAPAY-KEY' => env('RATAPAY_GW_API_KEY'),
                    'X-RATAPAY-TS' => $isoTime,
                    'Authorization' => 'Bearer ' . $token['access_token'],
                ],
            ]);
            $resBody = (string)$res->getBody();
            $resBody = json_decode($resBody, true);
            return $resBody['account'];
        } catch (ClientException $exc) {
            throw new Exception($exc->getMessage());
        }
    }
}
