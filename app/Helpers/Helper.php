<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
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
    
   

}

return $request;



 }

}