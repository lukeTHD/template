<?php

namespace App\Helpers\Eticket;

use GuzzleHttp\Client;

class Call
{
    public static function connect($url, $method, $header, $data)
    {
        try {
            $client = new Client(['verify' => false]);
            $dataRequest = ['headers' => $header];
            if ($method === 'POST') {
                $dataRequest['json'] = ($data);
            }
            $res = $client->request($method, $url, $dataRequest);
//            dd($res);
            return $res->getBody()->getContents();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }
}
