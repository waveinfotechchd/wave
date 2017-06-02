<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\UserSearch;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image; 

class SearchController extends Controller
{
  
    
    public function searchpage(Request $request) 
    {
       if(Auth::check())
       { 
           $user_id=Auth::user()->id;
           $saved_search=DB::table('user_saved_search')->where(array('user_id'=>$user_id))->get();
           $exp_all=0;
           $avail_all=0;
           $imavail_all=0;
            if(isset($saved_search[0]->keyword) && !empty($saved_search[0]->keyword)){
                if(!empty($saved_search[0]->role)){
                    $role=$saved_search[0]->role;
                    $keyword=$saved_search[0]->keyword;
                    $user= DB::table('users')
		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
		   ->select('users.*')->orWhere('users.education',"LIKE","%$keyword%")
                    ->orWhere('users.experience',"LIKE","%$keyword%")
                   ->where('users.usertype','User')->where('users.first_name','!=','')
                    ->where('user_search.role',$role)
                    ->where('user_search.search_visibility','visible')     
		  ->get();
                }else{
                $keyword=$saved_search[0]->keyword;
                $user= DB::table('users')
		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
		   ->select('users.*')->orWhere('users.education',"LIKE","%$keyword%")
                    ->orWhere('users.experience',"LIKE","%$keyword%")
                   ->where('users.first_name','!=','')
                   ->where('user_search.search_visibility','visible')     
		  ->get();
                }
            }
            if(isset($saved_search[0]->role) && !empty($saved_search[0]->role)){
                $role=$saved_search[0]->role;
                 $user= DB::table('users')
		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
		   ->select('users.*')->where('user_search.role',$role)
                   ->where('users.usertype','User')->where('users.first_name','!=','')
                    ->where('user_search.search_visibility','visible')        
		   ->get();
            }
            if(isset($saved_search[0]->organisation) && !empty($saved_search[0]->organisation)){
                if(!empty($saved_search[0]->role)){
                       $role=$saved_search[0]->role;
                       $organisation=$saved_search[0]->organisation;
                 $user= DB::table('users')
		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
		   ->select('users.*')->where('user_search.organisation',"LIKE","%$organisation%")
                   ->where('users.usertype','User')->where('users.first_name','!=','')
                   ->where('user_search.role',$role)
                   ->where('user_search.search_visibility','visible')      
		   ->get();
                }else{
                $organisation=$saved_search[0]->organisation;
                 $user= DB::table('users')
		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
		   ->select('users.*')->where('user_search.organisation',"LIKE","%$organisation%")
                   ->where('users.usertype','User')->where('users.first_name','!=','')
                   ->where('user_search.search_visibility','visible')         
		   ->get();
                }
            }
            if(isset($saved_search[0]->experience) && !empty($saved_search[0]->experience)){
                    if(!empty($saved_search[0]->role)){
                    
                       $role=$saved_search[0]->role;
                        $experience=$saved_search[0]->experience;
                        $experience=unserialize($experience);
                $user= DB::table('users')
		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
		   ->select('users.*')->whereIn('user_search.experience',$experience)
                   ->where('users.usertype','User')->where('users.first_name','!=','')
                    ->where('user_search.role',$role)
                    ->where('user_search.search_visibility','visible')    
		   ->get();
            
                  
                    }else{
                    $experience=$saved_search[0]->experience;
                    $experience=unserialize($experience);
                    $user= DB::table('users')
		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
		   ->select('users.*')->whereIn('user_search.experience',$experience)
                   ->where('users.usertype','User')->where('users.first_name','!=','')
                   ->where('user_search.search_visibility','visible')       
		   ->get();
                
                    }
            }
              if(isset($saved_search[0]->availablility) && !empty($saved_search[0]->availablility)){
                    if(!empty($saved_search[0]->role)){
                        $role=$saved_search[0]->role;
                        $availablility=$saved_search[0]->availablility;
                        $availablility=unserialize($availablility);
                                $user= DB::table('users')
                                 ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
                                 ->select('users.*')->whereIn('user_search.availablility',$availablility)
                                 ->where('users.usertype','User')->where('users.first_name','!=','')
                                 ->where('user_search.role',$role)
                                 ->where('user_search.search_visibility','visible')       
                                 ->get();
                               
                                
                    }else{
                  $availablility=$saved_search[0]->availablility;
                  $availablility=unserialize($availablility);
                  $user= DB::table('users')
		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
		   ->select('users.*')->whereIn('user_search.availablility',$availablility)
                   ->where('users.usertype','User')->where('users.first_name','!=','')
                  ->where('user_search.search_visibility','visible')        
		   ->get();
                   
                    }
            }
              if(isset($saved_search[0]->immediate_availablility) && !empty($saved_search[0]->immediate_availablility)){
                  if(!empty($saved_search[0]->role)){
                       $role=$saved_search[0]->role;
                  
                        $immediate_availablility=$saved_search[0]->immediate_availablility;
                        $immediate_availablility=unserialize($immediate_availablility);
                  $user= DB::table('users')
		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
		   ->select('users.*')->whereIn('user_search.immediate_availablility',$immediate_availablility)
                   ->where('users.usertype','User')->where('users.first_name','!=','')
                   ->where('user_search.role',$role)
                   ->where('user_search.search_visibility','visible')       
		   ->get();
               
                  
                  }else{
                  $immediate_availablility=$saved_search[0]->immediate_availablility;
                  $immediate_availablility=unserialize($immediate_availablility);
                  $user= DB::table('users')
		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
		   ->select('users.*')->whereIn('user_search.immediate_availablility',$immediate_availablility)
                   ->where('users.usertype','User')->where('users.first_name','!=','')
                   ->where('user_search.search_visibility','visible')       
		   ->get();
                  
                  }
            }
          
            return view('pages.search',compact('user','saved_search'));
       }
       else
       {
            return view('pages.register');
       }
    }
    public function search_filter(Request $request) 
    {
        $inputs = $_REQUEST;
     
          $user_id=Auth::user()->id;
         if(isset($inputs['keyword']) && !empty($inputs['keyword']))
        {
          if(!empty($inputs['role'])){
             $role =$inputs['role'];
             $keyword =$inputs['keyword'];
            $user= DB::table('users')
		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
		   ->select('users.*')->orWhere('users.education',"LIKE","%$keyword%")
                    ->orWhere('users.experience',"LIKE","%$keyword%")
                   ->where('users.usertype','User')->where('users.first_name','!=','')
                    ->where('user_search.search_visibility','visible')   
		   ->get();
          }else{
            $keyword =$inputs['keyword'];
            $user= DB::table('users')
		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
		   ->select('users.*')->orWhere('users.education',"LIKE","%$keyword%")
                    ->orWhere('users.experience',"LIKE","%$keyword%")
                   ->where('users.usertype','User')->where('users.first_name','!=','')
                   ->where('user_search.role',$role)  
                    ->where('user_search.search_visibility','visible')
		   ->get();
          }
            $count=DB::table('user_saved_search')->where(array('user_id'=>$user_id))->count();
           if($count>0){
                DB::table('user_saved_search')->where(array('user_id'=>$user_id))->update(['keyword'=>$inputs['keyword']]);
           }else{
           DB::table('user_saved_search')->insertGetId(['keyword'=>$inputs['keyword'],'user_id'=>$user_id]);
                 
           }
           // print_r($user);
        }
        if(empty($inputs['keyword'])){
         $count=DB::table('user_saved_search')->where(array('user_id'=>$user_id))->count();
           if($count>0){
                DB::table('user_saved_search')->where(array('user_id'=>$user_id))->update(['keyword'=>'']);
           }else{
           DB::table('user_saved_search')->insertGetId(['keyword'=>'','user_id'=>$user_id]);
                 
           }
        }
         if(isset($inputs['organisation']) && !empty($inputs['organisation']))
        {
             if(!empty($inputs['role'])){
             $role =$inputs['role'];
             $organisation =$inputs['organisation'];
             $user= DB::table('users')
		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
		   ->select('users.*')->where('user_search.role',$role)->where('user_search.organisation',"LIKE","%$organisation%")
                   ->where('users.usertype','User')->where('users.first_name','!=','')
                   ->where('user_search.search_visibility','visible')   
		   ->get();
             }else{
            $organisation =$inputs['organisation'];
            $user= DB::table('users')
		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
		   ->select('users.*')->where('user_search.organisation',"LIKE","%$organisation%")
                   ->where('users.usertype','User')->where('users.first_name','!=','')
                   ->where('user_search.search_visibility','visible')   
		   ->get();
             }
           // print_r($user);
             $count=DB::table('user_saved_search')->where(array('user_id'=>$user_id))->count();
           if($count>0){
                DB::table('user_saved_search')->where(array('user_id'=>$user_id))->update(['organisation'=>$inputs['organisation']]);
           }else{
           DB::table('user_saved_search')->insertGetId(['organisation'=>$inputs['organisation'],'user_id'=>$user_id]);
                 
           }
        }
        if(empty($inputs['organisation'])){
          $count=DB::table('user_saved_search')->where(array('user_id'=>$user_id))->count();
           if($count>0){
                DB::table('user_saved_search')->where(array('user_id'=>$user_id))->update(['organisation'=>'']);
           }else{
           DB::table('user_saved_search')->insertGetId(['organisation'=>'','user_id'=>$user_id]);
                 
           }
        }
       // die();
        if(isset($inputs['role']) && !empty($inputs['role']))
        {
            $role =$inputs['role'];
            $user= DB::table('users')
		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
		   ->select('users.*')->where('user_search.role',$role)
                   ->where('users.usertype','User')->where('users.first_name','!=','')
                    ->where('user_search.search_visibility','visible')   
		   ->get();
           //print_r($user);
                $count=DB::table('user_saved_search')->where(array('user_id'=>$user_id))->count();
           if($count>0){
                DB::table('user_saved_search')->where(array('user_id'=>$user_id))->update(['role'=>$inputs['role']]);
           }else{
           DB::table('user_saved_search')->insertGetId(['role'=>$inputs['role'],'user_id'=>$user_id]);
                 
           }
        }
        if(isset($inputs['experience']) && !empty($inputs['experience']))
        {
           if(!empty($inputs['role'])){
               $role =$inputs['role'];
                $experience =$inputs['experience'];
              
               if(!empty($inputs['experience']) && !empty($inputs['Iavailability'])&& !empty($inputs['availability'])){
                    $Iavailability =$inputs['Iavailability'];
               $availability =$inputs['availability'];
                   $user= DB::table('users')
                            ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
                            ->select('users.*')->where('user_search.role',$role)->whereIn('user_search.availablility',$availability)->whereIn('user_search.immediate_availablility',$Iavailability)->whereIn('user_search.experience',$experience)
                            ->where('users.usertype','User')->where('users.first_name','!=','')
                             ->where('user_search.search_visibility','visible')  
                            ->get();
               }elseif(!empty($inputs['experience']) && !empty($inputs['Iavailability'])){
                    $Iavailability =$inputs['Iavailability'];
               
                    $user= DB::table('users')
                            ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
                            ->select('users.*')->where('user_search.role',$role)->whereIn('user_search.immediate_availablility',$Iavailability)->whereIn('user_search.experience',$experience)
                            ->where('users.usertype','User')->where('users.first_name','!=','')
                             ->where('user_search.search_visibility','visible')  
                            ->get();
               }elseif(!empty($inputs['experience']) && !empty($inputs['availability'])){
                   $availability =$inputs['availability'];
                    $user= DB::table('users')
                            ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
                            ->select('users.*')->where('user_search.role',$role)->whereIn('user_search.availablility',$availability)->whereIn('user_search.experience',$experience)
                            ->where('users.usertype','User')->where('users.first_name','!=','')
                             ->where('user_search.search_visibility','visible')  
                            ->get();
               }else{
                    $user= DB::table('users')
                            ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
                            ->select('users.*')->where('user_search.role',$role)->whereIn('user_search.experience',$experience)
                            ->where('users.usertype','User')->where('users.first_name','!=','')
                            ->where('user_search.search_visibility','visible')  
                            ->get();
               }
           }
           //else{
//           $experience =$inputs['experience'];
//     
//           $user= DB::table('users')
//		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
//		   ->select('users.*')->whereIn('user_search.experience',$experience)
//                   ->where('users.usertype','User')->where('users.first_name','!=','')
//                    ->where('users.id','!=',$user_id)  
//		   ->get();
//           }
           //print_r($user);
           $experience=serialize($experience);
                 $count=DB::table('user_saved_search')->where(array('user_id'=>$user_id))->count();
               
           if($count>0){
                DB::table('user_saved_search')->where(array('user_id'=>$user_id))->update(['experience'=>$experience]);
           }else{
           DB::table('user_saved_search')->insertGetId(['experience'=>$experience,'user_id'=>$user_id]);
                 
           }
           
       
        }
        if(isset($inputs['Iavailability']) && !empty($inputs['Iavailability']))
        {
            if(!empty($inputs['role'])){
                $role =$inputs['role'];
                $Iavailability =$inputs['Iavailability'];
                
                     if(!empty($inputs['experience'])){
                           $experience =$inputs['experience'];
            $user= DB::table('users')
		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
		   ->select('users.*')->where('user_search.role',$role)->whereIn('user_search.immediate_availablility',$Iavailability)->whereIn('user_search.experience',$experience)
                   ->where('users.usertype','User')->where('users.first_name','!=','')
                   ->where('user_search.search_visibility','visible')  
		   ->get();
                     }elseif(!empty($inputs['experience']) && !empty($inputs['availability'])){
                         $availability =$inputs['availability'];
                    $user= DB::table('users')
                            ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
                            ->select('users.*')->where('user_search.role',$role)->whereIn('user_search.immediate_availablility',$Iavailability)->whereIn('user_search.availablility',$availability)->whereIn('user_search.experience',$experience)
                            ->where('users.usertype','User')->where('users.first_name','!=','')
                          ->where('user_search.search_visibility','visible')  
                            ->get();
               }else{
                         $user= DB::table('users')
		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
		   ->select('users.*')->where('user_search.role',$role)->whereIn('user_search.immediate_availablility',$Iavailability)
                   ->where('users.usertype','User')->where('users.first_name','!=','')
                   ->where('user_search.search_visibility','visible')  
		   ->get(); 
                     }
            }
//            else{
//            $Iavailability =$inputs['Iavailability'];
//            $user= DB::table('users')
//		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
//		   ->select('users.*')->whereIn('user_search.immediate_availablility',$Iavailability)
//                   ->where('users.usertype','User')->where('users.first_name','!=','')
//                   ->where('users.id','!=',$user_id)  
//		   ->get();
//            }
          // print_r($user);
          $Iavailability=serialize($Iavailability);
                     $count=DB::table('user_saved_search')->where(array('user_id'=>$user_id))->count();
           if($count>0){
                DB::table('user_saved_search')->where(array('user_id'=>$user_id))->update(['immediate_availablility'=>$Iavailability]);
           }else{
           DB::table('user_saved_search')->insertGetId(['immediate_availablility'=>$Iavailability,'user_id'=>$user_id]);
                 
           }
       
        }
         if(isset($inputs['availability']) && !empty($inputs['availability']))
        {
             if(!empty($inputs['role'])){
                $role =$inputs['role'];
                   $availability =$inputs['availability'];
                   if(!empty($inputs['experience'])){
                     $experience =$inputs['experience'];
                      $Iavailability =$inputs['Iavailability'];
           $user= DB::table('users')
		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
		   ->select('users.*')->where('user_search.role',$role)->whereIn('user_search.availablility',$availability)->whereIn('user_search.immediate_availablility',$Iavailability)->whereIn('user_search.experience',$experience)
                   ->where('users.usertype','User')->where('users.first_name','!=','')
                    ->where('user_search.search_visibility','visible')  
		   ->get();
                     }elseif(!empty($inputs['experience']) && !empty($inputs['Iavailability'])){
                         $Iavailability =$inputs['Iavailability'];
                    $user= DB::table('users')
                            ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
                            ->select('users.*')->where('user_search.role',$role)->whereIn('user_search.availablility',$availability)->whereIn('user_search.immediate_availablility',$Iavailability)->whereIn('user_search.experience',$experience)
                            ->where('users.usertype','User')->where('users.first_name','!=','')
                             ->where('user_search.search_visibility','visible')  
                            ->get();
               }else{
                         $user= DB::table('users')
		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
		   ->select('users.*')->where('user_search.role',$role)->whereIn('user_search.availablility',$availability)
                   ->where('users.usertype','User')->where('users.first_name','!=','')
                   ->where('user_search.search_visibility','visible')  
		   ->get();  
                     }
             }
//             else{
//           $availability =$inputs['availability'];
//           $user= DB::table('users')
//		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
//		   ->select('users.*')->whereIn('user_search.availablility',$availability)
//                   ->where('users.usertype','User')->where('users.first_name','!=','')
//                    ->where('users.id','!=',$user_id)  
//		   ->get();
//             }
          // print_r($user);
          $availability=serialize($availability);
                     $count=DB::table('user_saved_search')->where(array('user_id'=>$user_id))->count();
           if($count>0){
                DB::table('user_saved_search')->where(array('user_id'=>$user_id))->update(['availablility'=>$availability]);
           }else{
           DB::table('user_saved_search')->insertGetId(['availablility'=>$availability,'user_id'=>$user_id]);
                 
           }
        }
        if(isset($inputs['availability_all'])){
            if($inputs['availability_all']=='All' && !empty($inputs['role'])){
              $role=$inputs['role'];
                 $availability =$inputs['availability'];
              if(!empty($inputs['experience'])){
              $experience =$inputs['experience'];
             
              $user= DB::table('users')
		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
		   ->select('users.*')->where('user_search.role',$role)->whereIn('user_search.availablility',$availability)->whereIn('user_search.experience',$experience)
                   ->where('users.usertype','User')->where('users.first_name','!=','')
                  ->where('user_search.search_visibility','visible')  
		   ->get();
               }else{
                 $user= DB::table('users')
		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
		   ->select('users.*')->where('user_search.role',$role)->whereIn('user_search.availablility',$availability)
                   ->where('users.usertype','User')->where('users.first_name','!=','')
                  ->where('user_search.search_visibility','visible')  
		   ->get();   
               }
                $availability=serialize($availability);
                       $count=DB::table('user_saved_search')->where(array('user_id'=>$user_id))->count();
                        if($count>0){
                             DB::table('user_saved_search')->where(array('user_id'=>$user_id))->update(['availablility'=>$availability]);
                        }else{
                        DB::table('user_saved_search')->insertGetId(['availablility'=>$availability,'user_id'=>$user_id]);

                        }
            }
        }
        if(isset($inputs['Iavailability_all'])){
            
            if($inputs['Iavailability_all']=='All' && !empty($inputs['role'])){
              $role=$inputs['role'];
               $Iavailability =$inputs['Iavailability'];
              if(!empty($inputs['experience'])){
              $experience =$inputs['experience'];
             
              $user= DB::table('users')
		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
		   ->select('users.*')->where('user_search.role',$role)->whereIn('user_search.immediate_availablility',$Iavailability)->whereIn('user_search.experience',$experience)
                   ->where('users.usertype','User')->where('users.first_name','!=','')
                  ->where('user_search.search_visibility','visible')  
		   ->get();
              }else{
                   $user= DB::table('users')
		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
		   ->select('users.*')->where('user_search.role',$role)->whereIn('user_search.immediate_availablility',$Iavailability)
                   ->where('users.usertype','User')->where('users.first_name','!=','')
                   ->where('user_search.search_visibility','visible')  
		   ->get();
              }
              $Iavailability=serialize($Iavailability);
                        $count=DB::table('user_saved_search')->where(array('user_id'=>$user_id))->count();
           if($count>0){
                DB::table('user_saved_search')->where(array('user_id'=>$user_id))->update(['immediate_availablility'=>$Iavailability]);
           }else{
           DB::table('user_saved_search')->insertGetId(['immediate_availablility'=>$Iavailability,'user_id'=>$user_id]);
                 
           }
            }
        }
         if(isset($inputs['experience_all'])){
            
            if($inputs['experience_all']=='All' && !empty($inputs['role'])){
              $role=$inputs['role'];
               $experience =$inputs['experience'];
              $user= DB::table('users')
		   ->leftJoin('user_search', 'user_search.user_id', '=', 'users.id')
		   ->select('users.*')->where('user_search.role',$role)->whereIn('user_search.experience',$experience)
                   ->where('users.usertype','User')->where('users.first_name','!=','')
                   ->where('user_search.search_visibility','visible')  
		   ->get();
                    $count=DB::table('user_saved_search')->where(array('user_id'=>$user_id))->count();
                $experience=serialize($experience);
           if($count>0){
                DB::table('user_saved_search')->where(array('user_id'=>$user_id))->update(['experience'=>$experience]);
           }else{
           DB::table('user_saved_search')->insertGetId(['experience'=>$experience,'user_id'=>$user_id]);
                 
           }
            }
        }
        
        
         if(empty($inputs['availability']) && empty($inputs['keyword']) && empty($inputs['keyword']) && empty($inputs['Iavailability']) && empty($inputs['experience']) && empty($inputs['role']) && empty($inputs['organisation']))
        {
//             $user_id=Auth::user()->id;
//              $user= DB::table('users')
//                   ->where('users.usertype','User')->where('users.first_name','!=','')
//                     ->where('users.id','!=',$user_id)    
//		   ->get();
             $user='a';
         }
//           echo'<pre>'; print_r($user);  
//        die();  
         return view('pages.load_search_users',compact('user'));
    }
        public function veiw_profile(Request $request)
        { 
            if(!Auth::check())
           {
                \Session::flash('flash_message', 'Access denied!');
                return redirect('login');
            }
            $user_id=$request->id;
            $user = User::findOrFail($user_id);
            $usersearch = UserSearch::where('user_id',$user_id)->get();
            return view('pages.users_profile_view',compact('user','usersearch'));
        } 
        
           public function setting_page(Request $request)
        { 
            if(!Auth::check())
           {
                \Session::flash('flash_message', 'Access denied!');
                return redirect('login');
            }
            $user_id=Auth::user()->id;
            $usersearch = UserSearch::where('user_id',$user_id)->get();
            return view('pages.setting',compact('usersearch'));
        }
        
        public function save_search_setting(Request $request)
        { 
            if(!Auth::check())
           {
                \Session::flash('flash_message', 'Access denied!');
                return redirect('login');
            }
            $search_status=$request->search_status;
            $search_visibility=$request->search_visibility;
            $email='';
            $messages='';
            $phone='';
            if(!empty($request->contact)){
                $contact= array();
                $contact=$request->contact;
                $cnt=count($contact);
                for($i=0;$i<$cnt;$i++)
                {
                    if($contact[$i]=='email')
                    {
                     $email=$contact[$i];
                    }
                    if($contact[$i]=='messages')
                    {
                     $messages=$contact[$i];
                    }
                    if($contact[$i]=='phone')
                    {
                     $phone=$contact[$i];
                    }
                }
            }
           // die('');
            $user_id=Auth::user()->id;
            DB::table('user_search')->where(array('user_id'=>$user_id))->update(['search_visibility'=>$search_visibility,'search_status'=>$search_status,'setting_email'=>$email,'setting_messages'=>$messages,'setting_phone'=>$phone]);
            $usersearch = UserSearch::where('user_id',$user_id)->get();
            return view('pages.setting',compact('usersearch'));
        }
         public function save_actions(Request $request) {
            
            $user_id=Auth::user()->id;
            $inputs = $_REQUEST;
            $req_userid=$inputs['user_id'];
            $type=$inputs['type'];
           $status=$inputs['status']; 
        
                
            if($type=='Sent'){
                
            DB::table('user_invites')->where(array('id'=>$req_userid))->update(['status'=>$status]);
            
            if($status=='DECLINED'){
              DB::table('user_invites')->where(array('id'=>$req_userid))->update(array('status'=>$status,'shortlist'=>'no'));
              DB::table('user_shortlists')->where(array('user_id'=>$user_id))->delete();   
                
            }
            if($status=='CANCELLED'){
              DB::table('user_invites')->where(array('id'=>$req_userid))->update(array('status'=>$status,'shortlist'=>'no'));
             DB::table('user_shortlists')->where(array('to_user_id'=>$user_id))->delete();   
                
            }
            
            echo '<h1><span class="text-success">Invite was '.strtolower($status).' successfully !</span></h1>';
            }
             if($type=='Recieve'){
            DB::table('user_invites')->where(array('id'=>$req_userid))->update(['status'=>$status]);
            if($status=='DECLINED'){
              DB::table('user_invites')->where(array('id'=>$req_userid))->update(array('status'=>$status,'shortlist'=>'no'));
             DB::table('user_shortlists')->where(array('user_id'=>$user_id))->delete();    
                
            }
            if($status=='CANCELLED'){
             DB::table('user_invites')->where(array('id'=>$req_userid))->update(array('status'=>$status,'shortlist'=>'no'));
             DB::table('user_shortlists')->where(array('user_id'=>$user_id))->delete();   
                
            }
            echo '<h1><span class="text-success">Invite was '.strtolower($status).' successfully !</span></h1>';
            
             
            }
             if($type=='Shortlist'){
              $count=DB::table('user_shortlists')->where(array('user_id'=>$user_id))->count();
           if($count>0){
                echo '<h1><span class="text-info">Invite was already shortlisted  !</span></h1>';
           }else{
            DB::table('user_shortlists')->insertGetId(['user_id'=>$user_id,'to_user_id'=>$req_userid,'status'=>'Pending']);
            echo '<h1><span class="text-success">Invite was shortlisted successfully !</span></h1>';
                }
            }
                    
        }
          public function  shortlist_page(Request $request) {
            
            $user_id=Auth::user()->id;
             if(!Auth::check())
           {
                \Session::flash('flash_message', 'Access denied!');
                return redirect('login');
            }
              $shortlist = DB::table('user_shortlists')->where('user_id',$user_id)->get();
              $shortlisted = DB::table('user_shortlists')->where('to_user_id',$user_id)->get();
            return view('pages.shortlist',compact('shortlist','shortlisted'));      
        }
       
}
