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
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;

class InviteController extends MainAdminController
{
     public function invites_page(Request $request)
        { 
            if(!Auth::check())
           {
                \Session::flash('flash_message', 'Access denied!');
                return redirect('login');
            }
           $user_id=Auth::user()->id;
           $invites=DB::table('user_invites')->get();
           return view('admin.pages.invites',  compact('invites'));
        } 
        
    public function delete_invite($id)
        {
            if(Auth::User()->usertype=="Admin")
            {
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
          public function conversation(Request $request)
        {
            if(Auth::User()->usertype=="Admin")
            {
            $UserConversations = UserConversations::orderby('id')->paginate('10');
            return view('admin.pages.conversations',  compact('UserConversations'));
            }
            else
            {
                \Session::flash('flash_message', 'Access denied!');

                return redirect('admin/dashboard');
            }
        }
             public function invite_filters()
    {
            
        $key=$_REQUEST['key'];
         $type=$_REQUEST['type'];
       
         
         if($type=='city'){
          $usersearch = UserSearch::where('city',$key)->get();
          $uid=array();
          foreach($usersearch as $ids){
              $uid[]=$ids->user_id;
          }
          $invites = DB::table('user_invites')->whereIn('user_id',$uid)->get();
         }
         if($type=='username'){
          $users = User::where('usertype','!=','Admin')->where('first_name',$key)->get();
          $uid=array();
          foreach($users as $ids){
              $uid[]=$ids->id;
          } 
          $invites = DB::table('user_invites')->whereIn('user_id',$uid)->get();
         }
         if($type=='sendafter'){
         $key=date("Y-m-d", strtotime($key));
          
          $invites = DB::table('user_invites')->where('created_at','>=',$key)->get();
         }
         if($type=='sendbefore'){
          $key=date("Y-m-d", strtotime($key));
          $invites = DB::table('user_invites')->where('created_at','<=',$key)->get();
         }
       
         return view('admin.pages.load_invites_filters',compact('invites'));
    }
   public function message_filters()
    {
            
        
         $type=$_REQUEST['type'];
       
         
         if($type=='city'){
          $key=$_REQUEST['key'];
          $usersearch = UserSearch::where('city',$key)->get();
          $uid=array();
          foreach($usersearch as $ids){
              $uid[]=$ids->user_id;
          }
          $UserConversations = DB::table('user_conversations')->whereIn('user_id',$uid)->get();
         }
         if($type=='username'){
             $username1=$_REQUEST['username1'];
             $username2=$_REQUEST['username2'];
          $users = User::where('usertype','!=','Admin')->where('first_name',$username1)->get();
          $uid=array();
          foreach($users as $ids){
              $uid[]=$ids->id;
          } 
           $users2 = User::where('usertype','!=','Admin')->where('first_name',$username2)->get();
          $uid2=array();
          foreach($users2 as $ids){
              $uid2[]=$ids->id;
          } 
          $UserConversations = DB::table('user_conversations')->whereIn('user_id',$uid)->whereIn('to_user_id',$uid2)->get();
         }
           if($type=='sendafter'){
               $key=$_REQUEST['key'];
            $key=date("Y-m-d", strtotime($key));
          
          $UserConversations = DB::table('user_conversations')->where('created_at','>=',$key)->get();
         }
         if($type=='sendbefore'){
             $key=$_REQUEST['key'];
          $key=date("Y-m-d", strtotime($key));
          $UserConversations = DB::table('user_conversations')->where('created_at','<=',$key)->get();
         }
       
         return view('admin.pages.load_messages_filters',compact('UserConversations'));
    }
}