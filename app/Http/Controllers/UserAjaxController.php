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
          

        


    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        if($request->user_id){
            $data=[
                'name' => $request->name,
                 'email' => $request->email,
            ];
        //    $User->where('id',$request->user_id)->update($data);        
        Helper::api_call("update/$request->user_id",'put',$data);
        return response()->json(['success'=>'User saved successfully.']);
    }else{
        $data=[
            'name' => $request->name,
             'email' => $request->email,
             'password' => $request->password
        ];

        $request = Helper::api_call('create-user','post',$data);   
      
        $data = json_decode($request->getbody()->getContents());
        if($data->message == "User Created Successfully"){
            return response()->json(['success'=>'User Created successfully.']);
     }else{
        return response()->json(['success'=>'User Creation failed.']);       
     }
     
    }
}

/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function edit($id)
{
    $user = Helper::api_call("edit/{$id}",'GET');  
    
    return response()->json($user);
}
/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function destroy($id)
{
   User::find($id)->delete();
 
   return response()->json(['success'=>'User deleted successfully.']);
}
}
