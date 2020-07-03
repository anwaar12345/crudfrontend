<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Session;
use Auth;

class Helper
{

 public static function api_call($url, $method, $arrayData = null, $content_type = 'json', $authheader = null)
 {
  
if($method=="GET")
{

    $client = new \GuzzleHttp\Client();
    $api = ['api-token' => 'dxddsjjmkikj'];
    $response = $client->request($method, env('API_URL').$url,['headers' => $api]);
    dd($response->getBody()->getContents());    
}

if($method=="post"){

$client = new \GuzzleHttp\Client();
    $body = $arrayData;
    $response = $client->request("POST", env('API_URL').$url, ['form_params'=>$body]);
    $response = $client->send($response);
    return $response;

}





 }

}