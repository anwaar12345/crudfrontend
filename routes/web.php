<?php

use Illuminate\Support\Facades\Route;
use App\Helpers\Helper;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {

// // $data= [
// // 'email' =>'shah@shah',
// // 'password' => 'shahji444'

// // ];
// //    $request = Helper::api_call('login','post',$data);
// $results = Helper::api_call('users','GET');
// dd($results);
// return view('welcome',compact('results'));

// });


// Route::post('/',function(){
//     Session::forget('api_token');
//     return redirect('/login');
// })->name('/');

Route::get('/register', 'AuthCustomerController@index');

Route::post('/post-register','AuthCustomerController@register');

Route::get('/login','AuthCustomerController@login');

Route::post('/post-login','AuthCustomerController@postlogin');
Route::post('/logout','AuthCustomerController@logout')->name('/logout');
Route::resource('users','UserAjaxController')->middleware('CheckUser');
