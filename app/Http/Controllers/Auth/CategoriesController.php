<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Listings;
use App\Categories;
use App\SubCategories;
use App\Location;
use App\ListingGallery;
use App\Reviews;
use App\Stores;

use App\ListingsVote;
use App\Useractivity;
use App\Cupowallet;
use App\ListingSubCategories;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
	
    public function categories(Request $request, $category_id, $category_slug)    { 
        
        if(isset($_GET['offer'])){
			$OfferDealPopUp = $_GET['offer'];
			$PopUpType = $_GET['type'];
			$offer_listing1 = Listings::where(array('id'=>$OfferDealPopUp))->get();
			$offer_listing = $offer_listing1[0];
			if(isset(Auth::user()->id))
			{
				$user_activity= new Useractivity;
				$user_activity->dataKey=$_GET['offer'];
				$user_activity->UserId=Auth::user()->id;
				$user_activity->save();
			}
		}
		$listings = Listings::where('final_cat_list','LIKE',"%".$category_id."%")->get();
		//echo "<pre>";print_r($Listings);die();
		$ListingsVote = ListingsVote::where(array('categoryId'=>$category_id))->count();
        $totalcount= count($listings);
		
		$dealstotalcount = Listings::where('final_cat_list','LIKE',"%".$category_id."%")->where('type','discount')->count();
        $coupontotalcount = Listings::where('final_cat_list','LIKE',"%".$category_id."%")->where('type','coupon')->count();
        
		if(isset(Auth::User()->id)){
			$UserId = Auth::User()->id;
		}else{
			$UserId = 'guest';
		}	
			//print_r($offer_listing);die();
       return view('pages.category',compact('listings','category_slug','category_id','UserId','offer_listing','PopUpType','ListingsVote','totalcount','dealstotalcount','coupontotalcount'));
    }
	public function allcategories()    { 
        
           if(isset(Auth::User()->id)){
				$UserId = Auth::User()->id;
			}else{
				$UserId = 'guest';
			}
		   return view('pages.allcategory',compact('UserId'));
    }
	 public function stores($store_id,$store_slug){
		
		if(isset($_GET['offer']))
		{
			$OfferDealPopUp = $_GET['offer'];
			$PopUpType = $_GET['type'];
			$offer_listing1 = Listings::where(array('id'=>$OfferDealPopUp))->get();
			$offer_listing = $offer_listing1[0];
			if(isset(Auth::user()->id))
			{
			$user_activity= new Useractivity;
			$user_activity->dataKey=$_GET['offer'];
			$user_activity->UserId=Auth::user()->id;
			$user_activity->save();
			}
		}
		   $store = Stores::where(array('store_id'=>$store_id))->get()[0];
		   $ListingsVote = ListingsVote::where(array('store'=>$store_id))->count();
		   $listings = Listings::where(array('store_id'=>$store_id))->orderBy('id','asc')->paginate(10); 
		   $ListingsCount = count($listings);
		   if(isset(Auth::User()->id)){
				$UserId = Auth::User()->id;
			}else{
				$UserId = '';
			}
		//echo "<pre>";print_r($store);die();
		return view('pages.stores',compact('listings','store','store_slug','UserId','offer_listing','PopUpType','ListingsVote','ListingsCount'));
    }
	public function allstores(){
			$Stores = Stores::groupBy('store_name')->get();
		   if(isset(Auth::User()->id)){
				$UserId = Auth::User()->id;
			}else{
				$UserId = 'guest';
			}
		   return view('pages.allstores',compact('Stores','UserId'));
		
    }
     public function recent_activity(){
         
        $user_activity= new Useractivity;
        $UserId=Auth::user()->id;
        $Listingsid= Useractivity::where(array('UserId'=>$UserId))->orderBy('created_at', 'desc')->take(10)->pluck('dataKey');
        $listings = Listings::whereIn('id',$Listingsid)->where('status','Active')->get();
	return view('pages.recent_activity',compact('listings'));
    }
     public function cupowallet(){
         
        $cupowallet= new Cupowallet;
        $UserId=Auth::user()->id;
        $cupowallet= Cupowallet::where(array('UserId'=>$UserId))->orderBy('created_at', 'desc')->get();
       // $listings = Listings::whereIn('id',$Listingsid)->where('status','Active')->get();
	return view('pages.cupowallet',compact('cupowallet'));
    }
    
	
}
