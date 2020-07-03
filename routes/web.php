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

Route::get('/', function () {

$data= [
'email' =>'shah@shah',
'password' => 'shahji444'

];
//    $request = Helper::api_call('login','post',$data);
$request = Helper::api_call('users','GET');

    
    // return view('welcome');
});
