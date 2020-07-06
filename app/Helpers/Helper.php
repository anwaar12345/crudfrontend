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
   

}else if($method="POST" && $url="create-user"){

    $client = new \GuzzleHttp\Client();
    $url = env('API_URL').$url;
   
    $body = $arrayData;
    $api = ['api-token' => Session::has('api_token')];

$request = $client->post($url,['headers' => $api],[
        
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
            ]
        ]
         
            ],
         
        );
    
        return $request;




}else if($method="put" && $url = "edit"){
    $client = new \GuzzleHttp\Client();
    $url = env('API_URL').$url;
   
    $body = $arrayData;
    $api = Session::has('api_token');

$request = $client->put($url,['headers' =>
[
    'api_token' => $api
]
],[
        
        'multipart' => [
            [
               'name' => 'name',
                'contents' => $body['name']
            ],
            [
                'name' => 'email',
                 'contents' => $body['email']
             ]
        ]
         
            ],
        );
    
        return $request;




}else{
    return $request;
}




 }

}