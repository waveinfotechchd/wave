<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\UserShortlists;
use App\UserTeam;
use App\UserOffers;
use App\UserSearch;
use App\Fieldsets;
use App\UserConversations;
use App\UserInvites;
use App\Cities;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;

class FieldsetsController extends MainAdminController
{
    
      public function fieldsSets(Request $request)
        { 
            if(!Auth::check())
           {
                \Session::flash('flash_message', 'Access denied!');
                return redirect('login');
            }
           $fieldsets=Fieldsets::orderBy('id')->paginate('10');
           return view('admin.pages.fieldsets',  compact('fieldsets'));
        } 
 
        public function fieldsSets_delete($id)
    {
        if(Auth::User()->usertype=="Admin" )
        {
            
         $fieldsets=Fieldsets::findOrFail($id);
 
         $fieldsets->delete();

        \Session::flash('flash_message', 'Deleted');

          return redirect('admin/fieldsets');
        }
        else
        {
            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        
        }
    }
    public function add_fieldsSets(Request $request)
    { 
         if(Auth::User()->usertype=="Admin" )
        {
        $data =  \Input::except(array('_token')) ;
        
        $rule=array(
                'fieldset_name' => 'required'                
                 );
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
        $inputs = $request->all();
        
        if(!empty($inputs['id'])){
           
            $fieldsets = Fieldsets::findOrFail($inputs['id']);

        }else{
            $fieldsets = new Fieldsets;
        }
        $fieldsets->field_value= $inputs['fieldset_name']; 
        $fieldsets->field_type= $inputs['fieldset_type']; 
        $fieldsets->save();
        if(!empty($inputs['id'])){

            \Session::flash('flash_message', 'Changes Saved');

          return redirect('admin/fieldsets');
        }else{

            \Session::flash('flash_message', 'Added');

       return redirect('admin/fieldsets');

        }            
          }
        else
        {
            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        
        }
         
    }   
        
}
 