<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\BaseCRUL;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JNE extends Controller
{
    private $baseCRUL;
    public function __construct(BaseCRUL $baseCRUL)
    {
        $this->baseCRUL = $baseCRUL;
    }

    public function price(Request $request)
    {
        $CURLOPT_URL = env('API_JNE_URL');
        $CURLOPT_CUSTOMREQUEST = 'POST';
        $CURLPOST_DATA = [
            'username' => env('API_JNE_USERNAME'),
            'api_key' => env('API_JNE_KEY'),
            'from' => $request->from,
            'thru' => $request->thru,
            'weight' => $request->weight,
        ];

        $response = $this->baseCRUL->API_POST($CURLOPT_URL, $CURLOPT_CUSTOMREQUEST, $CURLPOST_DATA);

        $data = json_decode($response);
        try {
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['status' => 405, 'message' => 'error', 'error_code' => $e->getMessage()]);
        }
    }
}
