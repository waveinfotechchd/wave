<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 

class AdminController extends MainAdminController
{
    public function __construct()
    {
        $this->middleware('auth');	
         
    }
    public function index()
    { 
        return view('admin.pages.dashboard');
    }
	
	public function profile()
    { 
        return view('admin.pages.profile');
    }
    
    public function updateProfile(Request $request)
    {  
    		 
    	$user = User::findOrFail(Auth::user()->id);
        $data =  \Input::except(array('_token')) ;
        $rule=array(
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|email|max:75|unique:users,id',
                    'image_icon' => 'mimes:jpg,jpeg,gif,png'
                             );
	   	$validator = \Validator::make($data,$rule);
            if ($validator->fails())
            {
                    return redirect()->back()->withErrors($validator->messages());
            }
	    $inputs = $request->all();
	    $icon = $request->file('user_icon');
        if($icon){
            $tmpFilePath = 'upload/members/';

            $hardPath =  str_slug($inputs['first_name'], '-').'-'.md5(time());

            $img = Image::make($icon);

            $img->fit(250, 250)->save($tmpFilePath.$hardPath.'-b.jpg');
            //$img->fit(80, 80)->save($tmpFilePath.$hardPath. '-s.jpg');

            $user->image_icon = $tmpFilePath.$hardPath.'-b.jpg';
        }
	$user->first_name = $inputs['first_name']; 
        $user->last_name = $inputs['last_name']; 
	$user->email = $inputs['email']; 
	$user->mobile = $inputs['mobile'];
       
	$user->save();
	Session::flash('flash_message', 'Successfully updated!');
        return redirect()->back();
    }
    
    public function updatePassword(Request $request)
    { 
        $data =  \Input::except(array('_token')) ;
        $rule  =  array(
        'password'       => 'required|confirmed',
        'password_confirmation'       => 'required'
        ) ;
        $validator = \Validator::make($data,$rule);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }
        $credentials = $request->only('password', 'password_confirmation');
        $user = \Auth::user();
        $user->password = bcrypt($credentials['password']);
        $user->save();
        Session::flash('flash_message', 'Successfully updated!');
        return redirect()->back();
    }
	 
    	
}
