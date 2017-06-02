<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\UserShortlists;
use App\UserTeam;
use App\UserOffers;
use App\UserSearch;
use App\UserInvites;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;

class TeamController extends MainAdminController
{
    public function  team_page(Request $request) {
            
          
             if(!Auth::check())
           {
                \Session::flash('flash_message', 'Access denied!');
                return redirect('login');
            }
             $teams = DB::table('user_team')->groupBy('user_id')->get();
              
            return view('admin.pages.teams',compact('teams'));      
        }
        public function delete_team($id)
        {
            if(Auth::User()->usertype=="Admin")
            {
            $UserTeam = UserTeam::where('user_id',$id)->delete();
          
             $UserShortlists = UserShortlists::where('user_id',$id)->delete();
            
             $UserInvites = UserInvites::where('user_id',$id)->delete();
          
            \Session::flash('flash_message', 'Deleted');
            return redirect()->back();
            }
            else
            {
                \Session::flash('flash_message', 'Access denied!');

                return redirect('admin/dashboard');


            }
        }   
           public function  team_details(Request $request) {
          
             if(!Auth::check())
           {
                \Session::flash('flash_message', 'Access denied!');
                return redirect('login');
            }
             $team= DB::table('user_team')->where('user_id',$request->team_id)->groupBy('team_name')->orderBy('id', 'asc')->get();
             $team_members= DB::table('user_team')->where('user_id',$request->team_id)->get();
            return view('admin.pages.team_detail',compact('team','team_members'));      
        }
           public function delete_team_member(Request $request)
        {
            if(Auth::User()->usertype=="Admin")
            {
            $UserTeam = UserTeam::where('to_user_id',$request->id)->where('user_id',$request->uid)->delete();
            $UserShortlists = UserShortlists::where('to_user_id',$request->id)->where('user_id',$request->uid)->delete();
             $UserInvites = UserInvites::where('to_user_id',$request->id)->where('user_id',$request->uid)->delete();
           
            \Session::flash('flash_message', 'Deleted');
            return redirect()->back();
            }
            else
            {
                \Session::flash('flash_message', 'Access denied!');

                return redirect('admin/dashboard');

            }
        }
          public function teams_filters()
    {
       
         $key=$_REQUEST['key'];
         $type=$_REQUEST['type'];
         if($type=='city'){
          $usersearch = UserSearch::where('city',$key)->get();
          $uid=array();
          foreach($usersearch as $ids){
              $uid[]=$ids->user_id;
          }
           $teams = DB::table('user_team')->whereIn('user_id',$uid)->groupBy('user_id')->get();
         }
        
         return view('admin.pages.load_teams_filters',compact('teams'));
    }
}