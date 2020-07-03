<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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

        // dd($data);
        
        $request = Helper::api_call('signup','post',$data);
        dd($request);
        return view('welcome',compact('results'));
        



}




}
