<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

use Auth;

class Helper
{

 public static function api_call($url, $method, $arrayData = null, $authheader = null)
 {
  
if($method=="GET")
{

    $client = new \GuzzleHttp\Client();
    $api = ['api-token' => Session::has('api_token')];
    $response = $client->request($method, env('API_URL').$url,['headers' => $api]);
    $result = json_decode($response->getBody()->getContents());
    if($result->success == true){
    
    return $result->data;
    
}

}

if($method=="post" && $url=="signup"){



    $client = new \GuzzleHttp\Client();
    $url = env('API_URL').$url;
   
    $body = $arrayData;
   


$request = $client->post($url,[
        
        'multipart' => [
          
            [
                'name' => 'name',
                 'contents' => $body['name']
            ],
            [
               'name' => 'email',
                'contents' => $body['email']
            ],
            [
                'name' => 'password',
                 'contents' => $body['password']
            ],
            [
                'name' => 'profile',
                'contents' => file_get_contents($body['profile']->getRealPath()),
                'filename' => $body['profile']->getClientOriginalName()
            ]
        ]
         
        ]
        );
    
        return true;
   

}else if($method=="post" && $url=="login"){

    $client = new \GuzzleHttp\Client();
    $url = env('API_URL').$url;
   
    $body = $arrayData;
   
$request = $client->post($url,[
        
        'multipart' => [
            [
               'name' => 'email',
                'contents' => $body['email']
            ],
            [
                'name' => 'password',
                 'contents' => $body['password']
            ]
        ]
         
        ]
        );
    
        return $request;
   

}else if($method=="post" && $url == "logout"){
    $client = new \GuzzleHttp\Client();
    $api = ['api-token' => Session::get('api_token')];
    
    $response = $client->request($method, env('API_URL').$url,['headers' => $api]);

    
        return $response;

}else{
    return $request;
}

 }

}