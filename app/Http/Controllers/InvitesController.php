<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\UserSearch;
use App\UserConversations;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Mail\Message;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image; 

class InvitesController extends Controller
{
    
    public function invites_page(Request $request)
        { 
            if(!Auth::check())
           {
                \Session::flash('flash_message', 'Access denied!');
                return redirect('login');
            }
           $user_id=Auth::user()->id;
           $sent_invites=DB::table('user_invites')->where(array('user_id'=>$user_id))->where('status','!=','DECLINED')->where('status','!=','CANCELLED')->get();
           $recived_invites=DB::table('user_invites')->where(array('to_user_id'=>$user_id))->where('status','!=','DECLINED')->where('status','!=','CANCELLED')->get();
           $sent_count=count($sent_invites);
           $recived_count=count($recived_invites);
                   return view('pages.invites',  compact('recived_invites','sent_invites','sent_count','recived_count'));
        } 
        public function user_invites(Request $request)
        { 
            if(!Auth::check())
            {
                \Session::flash('flash_message', 'Access denied!');
                 return redirect('login');
            }
           $inputs = $_REQUEST;
           $user_id=Auth::user()->id;
           $count=DB::table('user_invites')->where(array('to_user_id'=>$inputs['user_id'],'user_id'=>$user_id))->where('status','!=','DECLINED')->where('status','!=','CANCELLED')->count();
           $count2=DB::table('user_invites')->where(array('user_id'=>$inputs['user_id'],'to_user_id'=>$user_id))->where('status','!=','DECLINED')->where('status','!=','CANCELLED')->count();
           if($count>0){
                echo '<h1><span class="text-info">You have already invited this user!</span></h1>';
           }elseif($count2>0) {
            echo '<h1><span class="text-info">You have already received an invite from this user!</span></h1>';
           }
           else{
               $date = strtotime("+15 day");
               $exp_date=date('Y-m-d H:i:s', $date); 
               $to_userid=$inputs['user_id'];
               $touser=DB::table('users')->where(array('id'=>$to_userid))->select('first_name','email')->get();
              foreach($touser as $us){
               $touser=$us->first_name;
                $toemail=$us->email;
              }
                DB::table('user_invites')->insertGetId(['to_user_id'=>$inputs['user_id'],'user_id'=>$user_id,'status'=>'Pending','expired_date'=>$exp_date]);
                 echo '<h1><span class="text-success">Your invitation send successfully</span></h1>';
                 $data ="<h1>Dear ".$touser.",</h1><strong> You have recieved invitation from ".Auth::user()->first_name."</strong>";
                        $data = array(
                        'subject' => 'You have recieved invitation',
                        'user_message' =>$data,
                         );
                            $subject='You have recieved invitation';
                             \Mail::send('emails.email_template', $data, function ($message) use ($subject,$toemail){
                            $message->from(getcong('site_email'), getcong('site_name'));
                            $message->to($toemail)->subject($subject);

                        });
           }
            die();
        } 
            public function offer_message(Request $request)
        { 
            if(!Auth::check())
            {
                \Session::flash('flash_message', 'Access denied!');
                 return redirect('login');
            }
           $inputs = $_REQUEST;
           $user_id=Auth::user()->id;
           $team_name=ucfirst(Auth::user()->first_name).' Team';
           $owner_name=ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name);
           $message=$inputs['message'];
           $date = strtotime("+7 day");
           $exp_date=date('Y-m-d H:i:s', $date); 
           $count=DB::table('user_offers')->where(array('to_user_id'=>$inputs['to_user_id'],'user_id'=>$user_id))->count();
           if($count==0)
           {
            DB::table('user_offers')->insertGetId(['message'=>$message,'to_user_id'=>$inputs['to_user_id'],'user_id'=>$user_id,'status'=>'Pending','expired_date'=>$exp_date]);

           }
          $count2=DB::table('user_team')->where(array('to_user_id'=>$inputs['to_user_id'],'user_id'=>$user_id))->count();
           if($count2==0)
           {
            DB::table('user_team')->insertGetId(['user_id'=>$user_id,'owner_name'=>$owner_name,'team_name'=>$team_name,'to_user_id'=>$inputs['to_user_id'],'status'=>'Pending']);
           }
            return redirect('/shortlists');
        }
        public function save_shorlist_actions(Request $request){
            if(!Auth::check())
            {
                \Session::flash('flash_message', 'Access denied!');
                 return redirect('login');
            }
            $inputs =$_REQUEST;
            $user_id=Auth::user()->id;
            $req_userid=$inputs['to_user_id'];
            $status=$inputs['status'];
            $type=$inputs['type'];
              if($type=='Sent'){
               DB::table('user_shortlists')->where(array('id'=>$req_userid))->update(['status'=>$status]);
               
               $cnt=DB::table('user_offers')->where(array('id'=>$req_userid))->count();
               if($cnt>0){
                 DB::table('user_offers')->where(array('id'=>$req_userid))->update(['status'=>$status]);
               }
               echo '<h1><span class="text-success"> Shortlist was '.strtolower($status).' successfully!</span></h1>';
            }
            if($type=='Recieve'){
            DB::table('user_shortlists')->where(array('id'=>$req_userid))->update(['status'=>$status]);
            echo '<h1><span class="text-success">Shortlisted was '.strtolower($status).' successfully !</span></h1>';
            }
        }
        function send_message(Request $request){
             if(!Auth::check())
            {
                \Session::flash('flash_message', 'Access denied!');
                 return redirect('login');
            }
            $inputs =$_REQUEST;
            $user_id=Auth::user()->id;
           $message=$inputs['message']; 
          
            $to_user_id=$inputs['to_user_id'];
            DB::table('user_conversations')->insertGetId(['user_id'=>$user_id,'to_user_id'=>$to_user_id,'message'=>$message]);
            $sender_message=DB::table('user_conversations')->where(array('user_id'=>$user_id,'to_user_id'=>$to_user_id))->get();
            $recieve_message=DB::table('user_conversations')->where(array('user_id'=>$to_user_id,'to_user_id'=>$user_id))->get();
            $merge = array_merge($sender_message, $recieve_message); 
           
            return view('pages.load_messages',compact('merge','user_id')); 
        }
        
        function first_load_messages(Request $request){
             if(!Auth::check())
            {
                \Session::flash('flash_message', 'Access denied!');
                 return redirect('login');
            }
            $inputs =$_REQUEST;
            $user_id=Auth::user()->id;
            $to_user_id=$inputs['to_user_id'];
            $sender_message=DB::table('user_conversations')->where(array('user_id'=>$user_id,'to_user_id'=>$to_user_id))->get();
            $recieve_message=DB::table('user_conversations')->where(array('user_id'=>$to_user_id,'to_user_id'=>$user_id))->get();
            $merge = array_merge($sender_message, $recieve_message); 
      
            return view('pages.load_messages',compact('merge','user_id')); 
        }
  public function make_offer(Request $request)
        { 
            if(!Auth::check())
            {
                \Session::flash('flash_message', 'Access denied!');
                 return redirect('login');
            }
           $inputs = $_REQUEST;
           $inputs['message'];
          $to_userid=$inputs['to_user_id'];
          $user_id=Auth::user()->id;
         $to_teamcount=DB::table('user_team')->where(array('to_user_id'=>$user_id))->where('status','ACCEPTED')->count();
        
        if($to_teamcount>0)
           {
             echo "You must leave your team to Make an offer";
              die();
           }
           else{
            $touser=DB::table('users')->where(array('id'=>$to_userid))->select('first_name','email')->get();
            
              foreach($touser as $us){
               $touser=$us->first_name;
                 $toemail=$us->email;
              }
           $user_id=Auth::user()->id;
           $team_name=ucfirst(Auth::user()->first_name).' Team';
           $owner_name=ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name);
           $message=$inputs['message'];
           
           $date = strtotime("+7 day");
           $exp_date=date('Y-m-d H:i:s', $date); 
           $message_make_offer='Offer send to '.$touser.' for join '.$team_name.'! Offer expire`s on '.$exp_date;
          
           $countt=DB::table('user_offers')->where(array('to_user_id'=>$user_id,'user_id'=>$inputs['to_user_id']))->where('status','!=','CANCELED')->where('status','!=','DECLINED')->count();
           if($countt==0)
           {
           $count=DB::table('user_offers')->where(array('to_user_id'=>$inputs['to_user_id'],'user_id'=>$user_id))->where('status','!=','CANCELED')->where('status','!=','DECLINED')->count();
           if($count==0)
           {
            DB::table('user_offers')->insertGetId(['message'=>$message,'to_user_id'=>$inputs['to_user_id'],'user_id'=>$user_id,'status'=>'Pending','expired_date'=>$exp_date]);
            DB::table('user_conversations')->insertGetId(['user_id'=>$user_id,'to_user_id'=>$inputs['to_user_id'],'message'=>$message_make_offer]);
           
            $data ="<h1>Dear ".$touser.",</h1><strong>".$message_make_offer."</strong>";
            $data = array(
            'subject' => $message_make_offer,
            'user_message' =>$data,
             );
		$subject=$message_make_offer;
               
		 \Mail::send('emails.email_template', $data, function ($message) use ($subject,$toemail){
                $message->from(getcong('site_email'), getcong('site_name'));
                $message->to($toemail)->subject($subject);

            });
           }
        
          $count2=DB::table('user_team')->where(array('to_user_id'=>$inputs['to_user_id'],'user_id'=>$user_id))->count();
          
           if($count2==0)
           {
            DB::table('user_team')->insertGetId(['user_id'=>$user_id,'owner_name'=>$owner_name,'team_name'=>$team_name,'to_user_id'=>$inputs['to_user_id'],'status'=>'Pending']);
           }
          }
           // return redirect('/shortlists');
           echo 'done';
         die();
           }
        }    
        
        public function offer_recive_actions() {
            $inputs = $_REQUEST;
            $req_userid=$inputs['to_user_id'];
            $status=$inputs['status'];
            $nda=$inputs['nda'];
            $cnt=DB::table('user_offers')->where(array('id'=>$req_userid))->count();
               if($cnt>0){
                   
                      
                      $uid=DB::table('user_offers')->where(array('id'=>$req_userid))->select('to_user_id','user_id')->get();
                     
                      $to_userid=$uid[0]->to_user_id;
                      $userid=$uid[0]->user_id;
                       $touser=DB::table('users')->where(array('id'=>$to_userid))->select('first_name')->get();
                         $touser=$touser[0]->first_name;
                       $fromuser=DB::table('users')->where(array('id'=>$userid))->select('first_name','email')->get();
                       foreach($fromuser as $us){
                         $fromuser=$us->first_name;
                           $toemail=$us->email;
                        }
                      if($status=='CANCELED'){
                         $message_make_status=$fromuser.' Team`s '.$status.'  offer'; 
                      }elseif($status=='REMOVED'){
                         $message_make_status=$fromuser.' Team`s '.$status.'  offer'; 
                      }else{
                      $message_make_status=$touser.' '.$status.' '.$fromuser.'Team`s offer';
                      }
                      if($status=='ACCEPTED'){
                      
                          $user_id=Auth::user()->id;
                          $user_teamcount=DB::table('user_team')->where(array('user_id'=>$user_id))->where('status','ACCEPTED')->count(); 
                          $to_teamcount=DB::table('user_team')->where(array('to_user_id'=>$user_id))->where('status','ACCEPTED')->count();
                          if($user_teamcount>0) 
                            {
                              echo "You must delete your team to accept an offer";
                                die();
                            }elseif($to_teamcount>0)
                            {
                              echo "You must leave your team to accept an offer";
                              die();
                            }else{
                                DB::table('user_offers')->where(array('id'=>$req_userid))->update(['status'=>$status,'nda'=>$nda]);
                             
                                DB::table('user_conversations')->insertGetId(['user_id'=>$to_userid,'to_user_id'=>$userid,'message'=>$message_make_status]);
                                DB::table('user_team')->where(array('to_user_id'=>$to_userid,'user_id'=>$userid))->update(['status'=>$status,'nda'=>$nda]); 
                                 $data ="<h1>Dear ".$fromuser.",</h1><strong>".$message_make_status."</strong>";
                                  $data = array(
                                  'subject' => $message_make_status,
                                  'user_message' =>$data,
                                   );
                                $subject=$message_make_status;
                                 \Mail::send('emails.email_template', $data, function ($message) use ($subject,$toemail){
                                $message->from(getcong('site_email'), getcong('site_name'));
                                $message->to($toemail)->subject($subject);

                        });
                      echo 'done';
                            }
                             
                      }else{
                      DB::table('user_offers')->where(array('id'=>$req_userid))->update(['status'=>$status]);
                      DB::table('user_conversations')->insertGetId(['user_id'=>$to_userid,'to_user_id'=>$userid,'message'=>$message_make_status]);
                      DB::table('user_team')->where(array('to_user_id'=>$to_userid,'user_id'=>$userid))->update(['status'=>$status,'nda'=>$nda]); 
                       $data ="<h1>Dear ".$fromuser.",</h1><strong>".$message_make_status."</strong>";
                        $data = array(
                        'subject' => $message_make_status,
                        'user_message' =>$data,
                         );
                            $subject=$message_make_status;
                             \Mail::send('emails.email_template', $data, function ($message) use ($subject,$toemail){
                            $message->from(getcong('site_email'), getcong('site_name'));
                            $message->to($toemail)->subject($subject);

                        });
                      echo 'done';   }              
               }
               
             }
       public function make_shorlist(Request $request){
            if(!Auth::check())
            {
                \Session::flash('flash_message', 'Access denied!');
                 return redirect('login');
            }
            $inputs =$_REQUEST;
            $user_id=Auth::user()->id;
            $req_userid=$inputs['to_user_id'];
            
               $cnt=DB::table('user_shortlists')->where(array('to_user_id'=>$req_userid,'user_id'=>$user_id))->count();
               if($cnt>0){
                 DB::table('user_shortlists')->where(array('to_user_id'=>$req_userid,'user_id'=>$user_id))->update(['status'=>'Pending']);
                 DB::table('user_invites')->where(array('to_user_id'=>$req_userid,'user_id'=>$user_id))->update(['shortlist'=>'yes']);
                 DB::table('user_invites')->where(array('user_id'=>$req_userid,'to_user_id'=>$user_id))->update(['shortlist'=>'yes']);
               }else{
               DB::table('user_shortlists')->insertGetId(['to_user_id'=>$inputs['to_user_id'],'user_id'=>$user_id,'status'=>'Pending']);
               DB::table('user_invites')->where(array('user_id'=>$req_userid,'to_user_id'=>$user_id))->update(['shortlist'=>'yes']);
                DB::table('user_invites')->where(array('user_id'=>$user_id,'to_user_id'=>$req_userid))->update(['shortlist'=>'yes']);
               }
             return view('pages.load_shorlists_filters'); 
            
        }      
}