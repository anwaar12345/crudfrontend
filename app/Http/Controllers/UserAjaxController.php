<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;

use App\User;
use App\Helpers\Helper;
class UserAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index(Request $request)
    {
            if ($request->ajax()) {
                
               $data = Helper::api_call('users','GET');         
             
                
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                               $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editUser">Edit</a>';
       
                               $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteUser">Delete</a>';
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                }
                return view('welcome');
            }
          

}
