<?php

namespace App\Http\Controllers\Api\Traits;

class BaseCRUL
{
    public function API_GET($CURLOPT_URL, $CURLOPT_CUSTOMREQUEST)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $CURLOPT_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $CURLOPT_CUSTOMREQUEST,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return $response;
    }

    public function API_POST($CURLOPT_URL, $CURLOPT_CUSTOMREQUEST, $CURLPOST_DATA)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $CURLOPT_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $CURLOPT_CUSTOMREQUEST,
            CURLOPT_POSTFIELDS => http_build_query($CURLPOST_DATA),
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return $response;
    }
}
