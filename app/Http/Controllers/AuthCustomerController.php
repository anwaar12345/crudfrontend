<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthCustomerController extends Controller
{
    //
public function index()
{


 return view('register');

}

public function register(Request $request)
{
   
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|unique:users,email',
        'password' => 'required',
        'profile' => 'required'
    ]);

    if ($validator->fails()) {
        return redirect('/register')
                    ->withErrors($validator)
                    ->withInput();
    }

    $data= [
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
        'profile' => $request->profile     
        ];

        
        $request = Helper::api_call('signup','post',$data);
// dd($request);
        if($request){
        return back()
        ->with('message', 'Registered Successfully');
        
       }else{
           dd('failed Registration');
       }       



}


public function login()
{


    return view('login');
}



public function postlogin(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required',
        'password' => 'required'
    ]);
    if ($validator->fails()) {
        return redirect('/login')
                    ->withErrors($validator)
                    ->withInput();
    }


    $data = [
        'email' => $request->email,
        'password' => $request->password 
       ];
        
        $request = Helper::api_call('login','post',$data);
  
         
            $data = json_decode($request->getbody()->getContents());
    //    dd($data);
        if($data->message == "loggedin Successfully"){
           
              Session::put('api_token', $data->data->api_token);
          
           return redirect('users');
       }else if($data->message == "User not found"){
        return back()
        ->withErrors('User Not Found');           
       }else{
        return back()
        ->withErrors('logged in Failed | Invaled Username or Password |');
       }
            



}

   
public function logout()
{


    $request = Helper::api_call('logout','post');

         
    $data = json_decode($request->getbody()->getContents());
// dd($data->message);
if($data->message){
   
      Session::forget('api_token');
  
   return redirect('/login');
}
    





}

}



