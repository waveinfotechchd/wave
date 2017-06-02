<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class DashboardController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');	
         
    }
    public function index()
    { 
    	 if(Auth::user()->usertype=='Admin')	
          {  
            $month =Carbon::now()->month; 
            $year =Carbon::now()->year;
            $count_month_users = User::whereRaw('MONTH(created_at) = ?', [$month])->count();
            $count_year_users = User::whereRaw('YEAR(created_at) = ?', [$year])->count();
            $count_week_users = User::whereRaw('yearweek(DATE(created_at), 1) = yearweek(curdate(), 1)')->count();
            
            $count_week_invites=DB::table('user_invites')->whereRaw('yearweek(DATE(created_at), 1) = yearweek(curdate(), 1)')->count();
            $count_month_invites=DB::table('user_invites')->whereRaw('MONTH(created_at) = ?', [$month])->count();
            $count_year_invites=DB::table('user_invites')->whereRaw('YEAR(created_at) = ?', [$year])->count();
            
            $count_week_shortlists=DB::table('user_shortlists')->whereRaw('yearweek(DATE(created_at), 1) = yearweek(curdate(), 1)')->count();
            $count_month_shortlists=DB::table('user_shortlists')->whereRaw('MONTH(created_at) = ?', [$month])->count();
            $count_year_shortlists=DB::table('user_shortlists')->whereRaw('YEAR(created_at) = ?', [$year])->count();
            
            $count_week_team=DB::table('user_team')->whereRaw('yearweek(DATE(created_at), 1) = yearweek(curdate(), 1)')->count();
            $count_month_team=DB::table('user_team')->whereRaw('MONTH(created_at) = ?', [$month])->count();
            $count_year_team=DB::table('user_team')->whereRaw('YEAR(created_at) = ?', [$year])->count();
            
            $count_week_message=DB::table('user_conversations')->whereRaw('yearweek(DATE(created_at), 1) = yearweek(curdate(), 1)')->count();
            $count_month_message=DB::table('user_conversations')->whereRaw('MONTH(created_at) = ?', [$month])->count();
            $count_year_message=DB::table('user_conversations')->whereRaw('YEAR(created_at) = ?', [$year])->count();
           
            return view('admin.pages.dashboard',compact('count_month_users','count_year_users','count_week_users','count_week_invites','count_month_invites','count_year_invites','count_week_shortlists','count_month_shortlists','count_year_shortlists','count_week_team','count_month_team','count_year_team' ,'count_week_message','count_month_message','count_year_message'));
              }else{
                      \Session::flash('flash_message', 'Access denied!');
                      return redirect('logout');
              }
   
    	
        
    }
	
	 
    	
}
