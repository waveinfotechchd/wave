<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Mail;
use Illuminate\Mail\Message;
use App\UserSearch;
use App\UserTeam;
use App\UserOffers;
use App\UserShortlists;
use App\UserInvites;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image; 

class IndexController extends Controller
{
       
    public function index()
    { 
    	if(!$this->alreadyInstalled()) {
            return redirect('install');
        }
        if(Auth::check())
       { 
             if(!empty(Auth::user()->first_name)){ 
               
                return redirect('/dashboard');
                
               }else{ 
                    return redirect('/edit_profile');
               }
       }
       else
       {
            return view('pages.register');
       }
    }
    

 public function about_us()
    { 
                  
        return view('pages.about');
    }

    public function contact_us()
    {        
        return view('pages.contact');
    }

    public function termsandconditions()
    { 
                  
        return view('pages.termsandconditions');
    }

    public function privacypolicy()
    { 
                  
        return view('pages.privacypolicy');
    }

    /**
     * If application is already installed.
     *
     * @return bool
     */
    public function alreadyInstalled()
    {
        return file_exists(storage_path('installed'));
    }

    /**
     * Do user login
     * @return $this|\Illuminate\Http\RedirectResponse
     */
     
     public function login()
    { 
       if(Auth::check())
       { 
           
           if(!empty(Auth::user()->first_name)){ 
                return redirect('/profile');
               }else{ 
                    return redirect('/edit_profile');
               }
       }
       else
       {
            return view('pages.login');
       }

        
    }

    public function postLogin(Request $request)
    {
        
    //echo bcrypt('123456');
    //exit; 
        
      $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);


        $credentials = $request->only('email', 'password');

         
        
         if (Auth::attempt($credentials, $request->has('remember'))) {

           if(Auth::user()->status=='pending'){
                \Auth::logout();
                return redirect('/login')->withErrors('Your Account has not been Activated!');
            }
           if(Auth::user()->status=='SUSPENDED'){
                \Auth::logout();
                return redirect('/login')->withErrors('Your account has been suspended. Please contact support@findafounda.com');
            }
            return $this->handleUserWasAuthenticated($request);
        }

       // return array("errors" => 'The email or the password is invalid. Please try again.');
        //return redirect('/admin');
       return redirect('/login')->withErrors('The email or the password is invalid. Please try again.');
        
    }
    
     /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request)
    {

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::user());
        }

        return redirect('/'); 
    }
    
     public function forgot_password()
    { 
       
            return view('pages.forgot_password');
        
    }

    
    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();

        \Session::flash('flash_message', 'Logout successfully...');

        return redirect('/login');
    }

    public function register()
    { 
        return view('pages.register');
    }
    public function postRegister(Request $request)
    { 
        
        $data =  \Input::except(array('_token')) ;
        $inputs = $request->all();
        $rule=array(
                'email' => 'required|email|max:75|unique:users',
                'password' => 'required|min:3|confirmed'
                 );
         $validator = \Validator::make($data,$rule);
        if ($validator->fails())
        {
               // return redirect()->back()->withErrors($validator->messages());
                return view('pages.register',compact('inputs'))->withErrors($validator->messages());
        } 
          
       
        $user = new User;
        $user->usertype = 'User';
        $user->need__for_position = $inputs['need__for_position']; 
        $user->totalexperience = $inputs['experience'];       
        $user->position = $inputs['position'];  
//        $user->first_name = $inputs['first_name']; 
//        $user->last_name = $inputs['last_name']; 
        $user->ucode= 9 . rand(111,999) ;
        $user->email = $inputs['email'];         
        $user->password= bcrypt($inputs['password']); 
        $user->save();
        $inserted_id=$user->id;
        $user_search=new UserSearch;
        $user_search->user_id=$inserted_id;
        $user_search->role=$inputs['position'];
        $user_search->save();
        $experience=array();
        $experience[]=$inputs['experience'];
       $experience=  serialize($experience);
        DB::table('user_saved_search')->insertGetId(['role'=>$inputs['need__for_position'],'experience'=>$experience,'user_id'=>$inserted_id]);
   
         	$ucode=$user->ucode;
        	/* mail template */
		$URI = $uri = "http://" . $_SERVER['SERVER_NAME'];
		$emailt = getcong("site_email");
		
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		$data ="<h1>Dear User,</h1>
				<p><b>Registeration Date</b>: ". date('d-m-Y H:i')."</p>
				<strong>Thank you for Register with us .</strong>
				<p>Please confirm your account to <a href='".$URI."/confirm/".$ucode."'>Click here</a>.<p>";
            $data = array(
            'subject' => 'Confirmation Email',
            'user_message' =>$data,
             );
		$subject='Confirmation Email';
               
		 \Mail::send('emails.email_template', $data, function ($message) use ($subject){

                $message->from(getcong('site_email'), getcong('site_name'));

                $message->to($_REQUEST['email'])->subject($subject);

            });
            \Session::flash('flash_message', 'Thank you for registration. An email has been sent to '.$inputs['email'].'. Please check your email.');

          return redirect('/login');
         
    }    
 public function confirmRegister($confirm)
    { 
	//die('die');
	$count = User::where(array('ucode'=>$confirm,'status'=>'pending'))->count();
	//echo $count;die();
	if($count<1){
		return redirect('/login')->withErrors('The specified username does not exist in our system!or may be already email confirmed');
	}else{
		DB::table('users')->where('ucode' , $confirm)->update(['status' => 'NEW']);
		\Session::flash('flash_message', 'Your Email has been confirmed.');
		return redirect('/login');
	}
	} 
    public function dashboard()
    {  
     

         if(Auth::check())
       { 
            $user_id=Auth::user()->id;
            $user = User::findOrFail($user_id);
              
                 $count=DB::table('users')->where(array('id'=>$user_id))->count();
                 if($count>0){
                     $owner=DB::table('user_team')->where(array('user_id'=>$user_id))->count();
                     if($owner>0){
                     $team_name=DB::table('user_team')->where(array('user_id'=>$user_id))->pluck('team_name');
                     $founder=DB::table('user_team')->where(array('user_id'=>$user_id))->pluck('owner_name');
                     $team=DB::table('user_team')->where(array('user_id'=>$user_id))->where('status','ACCEPTED')->get();
                     $invites=DB::table('user_invites')->where(array('to_user_id'=>$user_id))->orderby('id')->limit('5')->get();
                     $user_conversations=DB::table('user_conversations')->where(array('to_user_id'=>$user_id))->orderby('id','dsec')->limit('2')->get();
                     $shortlists=DB::table('user_shortlists')->where(array('to_user_id'=>$user_id))->orderby('id')->limit('5')->get();
                     $rt=count($team_name);
                     $other_team_members='';
                     }else{
                         $team_name=DB::table('user_team')->where(array('to_user_id'=>$user_id))->where('status','ACCEPTED')->pluck('team_name');
                     $founder=DB::table('user_team')->where(array('to_user_id'=>$user_id))->where('status','ACCEPTED')->pluck('owner_name');
                     $team=DB::table('user_team')->where(array('to_user_id'=>$user_id))->where('status','ACCEPTED')->get();
                     $other_team=DB::table('user_team')->where(array('to_user_id'=>$user_id))->where('status','ACCEPTED')->pluck('user_id');
                     if(!empty($other_team)){ $other_user_id=$other_team[0];
                     $other_team_members=DB::table('user_team')->where(array('user_id'=>$other_user_id))->where('to_user_id','!=',$user_id)->where('status','ACCEPTED')->get();
                     }
                     else{
                         $other_team_members=''; 
                     }
                     $invites=DB::table('user_invites')->where(array('to_user_id'=>$user_id))->orderby('id')->limit('5')->get();
                     $user_conversations=DB::table('user_conversations')->where(array('to_user_id'=>$user_id))->orderby('id','dsec')->limit('2')->get();
                     $shortlists=DB::table('user_shortlists')->where(array('to_user_id'=>$user_id))->orderby('id')->limit('5')->get();
                     $rt=count($team_name); 
                     }
                      
                     if($rt==0){
                      $team_name=array();
                      $founder = array();
                      $team=array();
                      $team_name[]=Auth::user()->first_name.' Team';
                      $founder[]=Auth::user()->first_name.' '.Auth::user()->last_name;
                      $team=0;
                     } 
                 }else{ 
                      $team_name=array();
                      $founder = array();
                      $team=array();
                      $team_name[]=Auth::user()->first_name.' Team';
                      $founder[]=Auth::user()->first_name.' '.Auth::user()->last_name;
                      $team=0;
                 }
                 
            
                 return view('pages.dashboard',compact('team_name','founder','team','shortlists','invites','user_conversations','owner','other_team_members'));
        
       }
       else 
       {       
            return redirect('/login');
       }   
    } 

    public function profile()
    { 
        if(!Auth::check())
       {
            \Session::flash('flash_message', 'Access denied!');
            return redirect('login');
        }

        $user_id=Auth::user()->id;
        $user = User::findOrFail($user_id);
        $usersearch = UserSearch::where('user_id',$user_id)->get();
        return view('pages.profile',compact('user','usersearch'));
    } 
       public function ed_profile()
    { 
        if(!Auth::check())
       {
            \Session::flash('flash_message', 'Access denied!');
            return redirect('login');
        }

        $user_id=Auth::user()->id;
        $user = User::findOrFail($user_id);
        $usersearch = UserSearch::where('user_id',$user_id)->get();
        return view('pages.edit_profile',compact('user','usersearch'));
    } 

    public function editprofile(Request $request)
    { 
        
        $data =  \Input::except(array('_token')) ;
        
        $inputs = $request->all();
        
        
            $rule=array(
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|max:200'
                 );
       
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
          
        $user_id=Auth::user()->id;
           
        $user = User::findOrFail($user_id);
        
        $user_search_id=UserSearch::where('user_id',$user_id)->get();
     $user_search_id=$user_search_id[0]['id'];
        
       // die('come');
        $user_search=UserSearch::findOrFail($user_search_id);

        $icon = $request->file('user_icon');
         
        if($icon){

            
            $filename  = substr('userpic',0,100).'_'.time() . '-b.' .$icon->getClientOriginalExtension();
            $path = public_path('upload/members/' . $filename);
            Image::make($icon->getRealPath())->resize(250, 250)->save($path);
            $user->image_icon =$filename;
        }
          
        $first=$inputs['first_name'];
        $first=trim($first, " ");
        $user->first_name =$first;  
        $user->last_name = $inputs['last_name'];       
        $user->email = $inputs['email'];
        $user->mobile = $inputs['mobile'];
       
        $user->position = $inputs['position'];
        $user->totalexperience = $inputs['texperience'];
        
        $user->education = $inputs['education'];
        //$user->company = $inputs['company'];
        $user->groupe = $inputs['groupe'];
        $user->descr = $inputs['descr'];
        $user->experience = $inputs['experience'];
        
        $user->save();
        
        $user_search->city=$inputs['city'];  
        $user_search->experience=$inputs['texperience'];  
        $user_search->organisation=$inputs['organisation'];  
        $user_search->role=$inputs['position'];  
        $user_search->immediate_availablility=$inputs['immediate_availablility'];  
        $user_search->availablility=$inputs['availablility'];  
        $user_search->save();
         
            \Session::flash('flash_message', 'Changes Saved');
          $usersearch = UserSearch::where('user_id',$user_id)->get();

           return view('pages.edit_profile',compact('user','usersearch'));
         
         
    }        

    public function change_password()
    { 
          if(!Auth::check())
       {

            \Session::flash('flash_message', 'Access denied!');

            return redirect('login');
            
        }
        
        return view('pages.change_password');
    }

        
     public function edit_password(Request $request)
    { 
        
        $data =  \Input::except(array('_token')) ;
        
        $inputs = $request->all();
        
        $rule=array(                
                'password' => 'required|min:3|confirmed'
                 );
        
        
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
          
       
        $user_id=Auth::user()->id;
           
        $user = User::findOrFail($user_id);
       
        $user->password= bcrypt($inputs['password']);  
        
         
        $user->save(); 

            \Session::flash('flash_message', 'Password has been changed...');

            return \Redirect::back();

         
    } 

    public function stripe(Request $request) {
        
      $user_id=Auth::user()->id;
    
       $user_email=Auth::user()->email;
\Stripe\Stripe::setApiKey("sk_live_vOo5nGa9OXzuBW1goGOllI8s");

// Token is created using Stripe.js or Checkout!
// Get the payment token submitted by the form:

$token = $_REQUEST['token'];
$amount=$_REQUEST['amount'];
$amnt=$_REQUEST['amounts'];
$plan=$_REQUEST['plan'];

$coupon=$_REQUEST['coupon'];
 

// Create a Customer:
$customer = \Stripe\Customer::create(array(
  "email" => $user_email,
  "source" => $token,
));
$ammnt=$amount*100;
// Charge the Customer instead of the card:
$charge = \Stripe\Charge::create(array(
  "amount" => $ammnt,
  "currency" => "usd",
  "customer" =>$customer->id,
  "description" => $plan 
));
if($amnt=='99'){
$date = strtotime("+90 day");
}elseif($amnt=='149'){
 $date = strtotime("+180 day"); 
}elseif($amnt=='199'){
 $date = strtotime("+365 day"); 
}
$exp_date=date('Y-m-d H:i:s', $date);
$txnid=$charge->id;
$order_id=rand(0,1000000);
 echo $status=$charge['outcome']->seller_message;
$cnt=DB::table('user_subcriptions')->where(array('user_id'=>$user_id))->count();
if($cnt>0){
  DB::table('user_subcriptions')->where(array('user_id'=>$user_id))->update(['txn_id'=>$txnid, 'plan'=>$plan, 'amount'=>$amount,'coupon'=>$coupon,'expired_date'=>$exp_date,'status'=>$status,'order_id'=>$order_id]);
}else{
DB::table('user_subcriptions')->insertGetId(['user_id'=>$user_id,'txn_id'=>$txnid, 'plan'=>$plan, 'amount'=>$amount,'coupon'=>$coupon,'expired_date'=>$exp_date,'status'=>$status,'order_id'=>$order_id]);
}

DB::table('users')->where(array('id'=>$user_id))->update(['status'=>'MEMBER']);
$first_name=Auth::user()->first_name;
	$data ="<h1>Dear ".$first_name.",</h1>
				<p><b>Subscription Date</b>: ". date('d-m-Y H:i')."</p>
				<strong>Thank you for subscribe with us .</strong>
				<p>Your subscription plan is ".$plan.". Your subscription expired on " .$exp_date. "<p>";
            $data = array(
            'subject' => 'Thank you for subscribe with us',
            'user_message' =>$data,
             );
		$subject='Thank you for subscribe with us';
               
		 \Mail::send('emails.email_template', $data, function ($message) use ($subject){

                $message->from(getcong('site_email'), getcong('site_name'));

                $message->to(Auth::user()->email)->subject($subject);

            });
    } 
  
    public function copoun_apply(Request $request){
        $amount=$_REQUEST['amount'];
        $plan=$_REQUEST['plan'];
        $coupon=$_REQUEST['coupon'];
        $exp_coupon=date('Y-m-d H:i');

        if($coupon!='0'){
            $cnt=DB::table('coupons')->where(array('coupon_code'=>$coupon,'status'=>'Active'))->where('expired_date','>',$exp_coupon)->count();
            if($cnt>0){
                 $off=DB::table('coupons')->where(array('coupon_code'=>$coupon,'status'=>'Active'))->pluck('percentage_off');
                 $off=$off[0];
                 
                 $discount=$amount*$off/100;
                  $amount=$amount-$discount;
                 $amount=round($amount);
                 $df=$amount.','.$off;
                  $df;  
            }else{
                echo 'notworking';
                die();
            }
        }
    }

    public function delete_team_member(Request $request)
        {
            if(Auth::check())
            {
            $UserTeam = UserTeam::where('to_user_id',$request->id)->where('user_id',$request->uid)->delete();
            $UserOffers = UserOffers::where('to_user_id',$request->id)->where('user_id',$request->uid)->delete();
          //  $UserInvites = UserInvites::where('to_user_id',$request->id)->where('user_id',$request->uid)->delete();
          
            \Session::flash('flash_message', 'Deleted');
            return redirect()->back();
            }
            else
            {
                \Session::flash('flash_message', 'Access denied!');

                return redirect('/login');

            }
        } 
       public function delete_teams(Request $request)
        {
            if(Auth::check())
            {
            $UserTeam = UserTeam::where('user_id',$request->id)->delete();
            $UserOffers = UserOffers::where('user_id',$request->id)->delete();
            //$UserInvites = UserInvites::where('user_id',$request->id)->delete();
           
            \Session::flash('flash_message', 'Deleted');
            return redirect()->back();
            }
            else
            {
                \Session::flash('flash_message', 'Access denied!');

                return redirect('/login');

            }
        } 
         public function leave_team(Request $request)
        {
            if(Auth::check())
            {
            $UserTeam = UserTeam::where('to_user_id',$request->id)->delete();
            $UserOffers = UserOffers::where('to_user_id',$request->id)->delete();
            //$UserInvites = UserInvites::where('user_id',$request->id)->delete();
           
            \Session::flash('flash_message', 'Deleted');
            return redirect()->back();
            }
            else
            {
                \Session::flash('flash_message', 'Access denied!');

                return redirect('/login');

            }
        }
         public function conversation()
        { 
            if(!Auth::check())
            {
                \Session::flash('flash_message', 'Access denied!');
                return redirect('login');
            }else{
                      return view('pages.conversation');
            }
        }
           public function subscription()
        { 
            if(!Auth::check())
            {
                \Session::flash('flash_message', 'Access denied!');
                return redirect('login');
            }
             $user_id =  Auth::user()->id;   
             $expdata =  DB::table('user_subcriptions')->where(array('user_id'=>$user_id))->get();
             foreach($expdata as $getdata) {
             $exp_date = $getdata->expired_date;
             $status = $getdata->status;
              }
              $current_date =date("Y-m-d H:i:s");
              if(isset($exp_date)){
              $exped_date  =  $exp_date;
              }else{
              $exped_date=" ";   
              }
                   
                    if(isset($status)){
                    $string = str_replace(' ', '', $status);
                    $output = rtrim($string, '.');
                    $payval = 'Paymentcomplete';}
                    else{
                    $output ='';
                    $payval ='abc';
                    }
                    if($current_date < $exped_date && $output==$payval){
                    return view('pages.subscriptionredirect');   
                    }else{
                    return view('pages.subscription');
                    }
        }
}
