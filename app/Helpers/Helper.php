<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Session;
use Auth;

class Helper
{

 public static function api_call($url, $method, $arrayData = null, $authheader = null)
 {
  
if($method=="GET")
{

    $client = new \GuzzleHttp\Client();
    $api = ['api-token' => 'dxddsjjmkikj'];
    $response = $client->request($method, env('API_URL').$url,['headers' => $api]);
    $result = json_decode($response->getBody()->getContents());
    if($result->success == true){
    
    return $result->data;
    
}

}

if($method=="post"){



    $client = new \GuzzleHttp\Client();
    $url = env('API_URL').$url;
   
    $body = $arrayData;
    $i = ['profile' => [
        [
            'profile'     => $body['profile'],
            'contents' => fopen($body['profile'], 'r')
        ]]];
        // dd($i);
    //  dd($body['profile']);
    $request = $client->post($url,['form_params' => [
        'name' => $body['name'],
        'email' => $body['email'],
        'password' => $body['password'],
        'profile' => ['profile' => [
            [
                'profile'     => $body['profile'],
                'contents' => fopen($body['profile'], 'r')
            ]]]
        ]]);
    $response = $request->send();
  
    dd($response);

}





 }

}