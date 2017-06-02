<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\UserShortlists;
use App\UserTeam;
use App\UserOffers;
use App\UserInvites;
use App\UserSearch;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;

class ShortlistController extends MainAdminController
{
     public function  shortlist_page(Request $request) {
            
            $user_id=Auth::user()->id;
             if(!Auth::check())
           {
                \Session::flash('flash_message', 'Access denied!');
                return redirect('login');
            }
             $shortlist = DB::table('user_shortlists')->get();
              
            return view('admin.pages.shortlists',compact('shortlist'));      
        }
        public function delete_shortlist($id)
        {
            if(Auth::User()->usertype=="Admin")
            {
            $UserShortlists = UserShortlists::where('user_id',$id)->delete();
            
            \Session::flash('flash_message', 'Deleted');
            return redirect()->back();
            }
            else
            {
                \Session::flash('flash_message', 'Access denied!');

                return redirect('admin/dashboard');


            }
        }  
          public function shortlist_filters()
    {
            
         $key=$_REQUEST['key'];
         $type=$_REQUEST['type'];
         if($type=='city'){
          $usersearch = UserSearch::where('city',$key)->get();
          $uid=array();
          foreach($usersearch as $ids){
              $uid[]=$ids->user_id;
          }
          $shortlist = DB::table('user_shortlists')->whereIn('user_id',$uid)->get();
         }
         if($type=='username'){
          $users = User::where('usertype','!=','Admin')->where('first_name',$key)->get();
          $uid=array();
          foreach($users as $ids){
              $uid[]=$ids->id;
          } 
          $shortlist = DB::table('user_shortlists')->whereIn('user_id',$uid)->get();
         }
         return view('admin.pages.load_shortlists_filters',compact('shortlist'));
    }
}