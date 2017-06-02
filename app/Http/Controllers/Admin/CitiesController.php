<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\UserShortlists;
use App\UserTeam;
use App\UserOffers;
use App\UserSearch;
use App\UserConversations;
use App\UserInvites;
use App\Cities;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;

class CitiesController extends MainAdminController
{
    
      public function cities(Request $request)
        { 
            if(!Auth::check())
           {
                \Session::flash('flash_message', 'Access denied!');
                return redirect('login');
            }
           $cities=Cities::orderBy('id')->paginate('10');
           return view('admin.pages.cities',  compact('cities'));
        } 
        public function cities_status($id,$status)
        { 
           if(Auth::User()->usertype=="Admin")
        {
            
            $cities=Cities::findOrFail($id);
 
            
            $cities->status = $status;
 
            $cities->save();
         
            \Session::flash('flash_message', 'Status changed');

           return redirect('admin/cities');
        }
        else
        {
            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
             
        }
           
        }
        public function city_delete($id)
    {
        if(Auth::User()->usertype=="Admin" )
        {
            
         $cities=Cities::findOrFail($id);
 
         $cities->delete();

        \Session::flash('flash_message', 'Deleted');

          return redirect('admin/cities');
        }
        else
        {
            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        
        }
    }
    public function add_city(Request $request)
    { 
         if(Auth::User()->usertype=="Admin" )
        {
        $data =  \Input::except(array('_token')) ;
        
        $rule=array(
                'city_name' => 'required'                
                 );
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
        $inputs = $request->all();
        
        if(!empty($inputs['id'])){
           
            $city = Cities::findOrFail($inputs['id']);

        }else{
            $city = new Cities;
        }
        $city->city= $inputs['city_name']; 
        $city->status= 'Active'; 
        $city->save();
        if(!empty($inputs['id'])){

            \Session::flash('flash_message', 'Changes Saved');

          return redirect('admin/cities');
        }else{

            \Session::flash('flash_message', 'Added');

       return redirect('admin/cities');

        }            
          }
        else
        {
            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        
        }
         
    }   
        
}
 