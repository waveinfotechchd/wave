<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\UserSearch;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;

class UsersController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');	
		
		 parent::__construct();
         
    }
    public function userslist()    { 
         
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        } 
          
        $posts = User::where('usertype', '!=', 'Admin')->orderBy('id')->paginate(20);
       
         
        return view('admin.pages.users',compact('posts'));
    } 
     
    public function addeditUser()    { 
        
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
          
        return view('admin.pages.addeditUser');
    }
    
    public function addnew(Request $request)
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
          
        
           
        	if(!empty($inputs['id'])){
           
            $user = User::findOrFail($inputs['id']);
$user_id=$inputs['id'];
 $user_search_id=UserSearch::where('user_id',$user_id)->get();
        $user_search_id=$user_search_id[0]['id'];
       // die('come');
        $user_search=UserSearch::findOrFail($user_search_id);
        }else{

            $user = new User;
$user_search=new UserSearch;
        }
        
      

        $icon = $request->file('user_icon');
         
        if($icon){

            
            $filename  = substr('userpic',0,100).'_'.time() . '-b.' .$icon->getClientOriginalExtension();
            $path = public_path('upload/members/' . $filename);
            Image::make($icon->getRealPath())->resize(250, 250)->save($path);
            $user->image_icon =$filename;
        }
          
        
        $user->first_name = $inputs['first_name']; 
        $user->last_name = $inputs['last_name'];       
        $user->email = $inputs['email'];
        $user->mobile = $inputs['mobile'];
       $user->usertype = 'User';
        $user->position = $inputs['position'];
        $user->totalexperience = $inputs['texperience'];
        
        $user->education = $inputs['education'];
        //$user->company = $inputs['company'];
        $user->groupe = $inputs['groupe'];
        $user->descr = $inputs['descr'];
        $user->experience = $inputs['experience'];
        
        $user->save();
        if(empty($inputs['id'])){
        $user_id=$user->id;
        $user_search->user_id=$user_id;
        }
        
        $user_search->city=$inputs['city'];  
        $user_search->experience=$inputs['texperience'];  
        $user_search->organisation=$inputs['organisation'];  
        $user_search->role=$inputs['position'];  
        $user_search->immediate_availablility=$inputs['immediate_availablility'];  
        $user_search->availablility=$inputs['availablility'];  
        $user_search->save();
         
		
		if(!empty($inputs['id'])){

            \Session::flash('flash_message', 'Changes Saved');

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', 'Added');

            return \Redirect::back();

        }		     
        
         
    }     
    
    public function editUser($id)    
    {     
    	  if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }		
    		     
          $user = User::findOrFail($id);
                 $usersearch = UserSearch::where('user_id',$id)->get();
          return view('admin.pages.addeditUser',compact('user','usersearch'));
        
    }	 
    
    public function delete($id)
    {
    	
    	if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
    		
        $user = User::findOrFail($id);
        

        $listings = Listings::where('user_id',$user->id)->get();
        
        foreach ($listings as $listing_item) {

                $listing_gallery_obj = ListingGallery::where('listing_id',$listing_item->id)->get();
                
                foreach ($listing_gallery_obj as $listing_gallery) {
                    
                    \File::delete('upload/gallery/'.$listing_gallery->image_name);
                    \File::delete('upload/gallery/'.$listing_gallery->image_name);
                    
                    $listing_gallery_del = ListingGallery::findOrFail($listing_gallery->id);
                    $listing_gallery_del->delete(); 

                    
                }  

        $listing_del = Listings::findOrFail($listing_item->id);
        
        \File::delete('upload/listings/'.$listing_item->featured_image.'-b.jpg');
        \File::delete('upload/listings/'.$listing_item->featured_image.'-s.jpg');    

        $listing_del->delete(); 

        } 

         

		\File::delete(public_path() .'/upload/members/'.$user->image_icon.'-b.jpg');
		\File::delete(public_path() .'/upload/members/'.$user->image_icon.'-s.jpg');
			
		$user->delete();
		
        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }
         public function users_status($id,$status)
        { 
           if(Auth::User()->usertype=="Admin")
        {
            
            $User=User::findOrFail($id);
            $User->status = $status;
            $User->save();
            \Session::flash('flash_message', 'Status changed');

           return redirect('admin/users');
        }
        else
        {
            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
             
        }
           
        }
     
    public function user_filters()
    {
         $key=$_REQUEST['key'];
         $type=$_REQUEST['type'];
         if($type=='city'){
          $usersearch = UserSearch::where('city',$key)->get();
          $uid=array();
          foreach($usersearch as $ids){
              $uid[]=$ids->user_id;
          }
          $users = User::whereIn('id',$uid)->where('usertype','!=','Admin')->get();
         }
         if($type=='role'){
          $usersearch = UserSearch::where('role',$key)->get();
          $uid=array();
          foreach($usersearch as $ids){
              $uid[]=$ids->user_id;
          }
          $users = User::whereIn('id',$uid)->where('usertype','!=','Admin')->get();
         }
         if($type=='status'){
          $users = User::where('status',$key)->where('usertype','!=','Admin')->get();
         }
         return view('admin.pages.load_user_filters',compact('users'));
    }
    	
}
