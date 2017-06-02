<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Requests;
use App\User;
use App\UserSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class IndexController extends MainAdminController
{
	
    public function index()
    {   
    	if (Auth::check()) {
                        
            return redirect('admin/dashboard'); 
        }
 
        return view('admin.index');
    }
	
	/**
     * Do user login
     * @return $this|\Illuminate\Http\RedirectResponse
     */
	 
    public function postLogin(Request $request)
    {
    
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
         if (Auth::attempt($credentials, $request->has('remember'))) {

            if(Auth::user()->usertype=='banned'){
                \Auth::logout();
                return array("errors" => 'You account has been banned!');
            }
            return $this->handleUserWasAuthenticated($request);
        }
       return redirect('/admin')->withErrors('The email or the password is invalid. Please try again.');
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

        return redirect('admin/dashboard'); 
    }
        
    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();

        return redirect('admin/');
    }
    	 public function payments()
    {   
    	if (!Auth::check()) {
                        
            return redirect('/login'); 
        }
        $payments=DB::table('user_subcriptions')->get();
        return view('admin.pages.payments',compact('payments'));
    }
    	 public function payments_refunds(Request $request)
    {   
    	if (!Auth::check()) {
                        
            return redirect('/login'); 
        }
        $id=$request->id;
        $t_id=$request->t_id;
        $user_id=$request->u_id;
        \Stripe\Stripe::setApiKey("sk_test_OP3HkFcqZRyaykZph83p8WR0");
        $refund =\Stripe\Refund::create(array(
          "charge" => $t_id
        ));
//  echo '<pre>';
//print_r($refund);
//echo '</pre>';

$txnid=$refund->id;
$amount=$refund->amount;
$status='Refunds';

  DB::table('user_subcriptions')->where(array('id'=>$id))->update(['txn_id'=>$txnid,'amount'=>$amount,'status'=>$status]);
  DB::table('users')->where(array('id'=>$user_id))->update(['status'=>'NEW']);
        return redirect()->back();
    }
public function payment_filters()
    {
            
        $key=$_REQUEST['key'];
         $type=$_REQUEST['type'];
         
         if($type=='city'){
          $usersearch = UserSearch::where('city',$key)->get();
          $uid=array();
          foreach($usersearch as $ids){
              $uid[]=$ids->user_id;
          }
          $payments = DB::table('user_subcriptions')->whereIn('user_id',$uid)->get();
         }
         if($type=='username'){
          $users = User::where('usertype','!=','Admin')->where('first_name',$key)->get();
          $uid=array();
          foreach($users as $ids){
              $uid[]=$ids->id;
          } 
          
          $payments = DB::table('user_subcriptions')->whereIn('user_id',$uid)->get();
         }
         if($type=='sendafter'){
         $key=date("Y-m-d", strtotime($key));
          
          $payments = DB::table('user_subcriptions')->where('created_at','>=',$key)->get();
         }
         if($type=='sendbefore'){
          $key=date("Y-m-d", strtotime($key));
          $payments = DB::table('user_subcriptions')->where('created_at','<=',$key)->get();
         }
       
         return view('admin.pages.load_payment_filters',compact('payments'));
    }
}
