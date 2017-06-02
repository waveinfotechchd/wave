<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.

*/
/*
Route::get('/', function () {
    return view('welcome');
});*/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
	
	Route::get('/', 'IndexController@index');
	Route::post('login', 'IndexController@postLogin');
	Route::get('logout', 'IndexController@logout');
	Route::get('dashboard', 'DashboardController@index');
	Route::get('profile', 'AdminController@profile');	
	Route::post('profile', 'AdminController@updateProfile');	
	Route::post('profile_pass', 'AdminController@updatePassword');
	Route::get('settings', 'SettingsController@settings');	
	Route::post('settings', 'SettingsController@settingsUpdates');	
	Route::post('homepage_settings', 'SettingsController@homepage_settings');	
	Route::post('aboutus_settings', 'SettingsController@aboutus_settings');
	Route::post('contactus_settings', 'SettingsController@contactus_settings');
	Route::post('terms_of_service', 'SettingsController@terms_of_service');
	Route::post('privacy_policy', 'SettingsController@privacy_policy');
	Route::post('addthisdisqus', 'SettingsController@addthisdisqus');	
	Route::post('headfootupdate', 'SettingsController@headfootupdate');
        
	Route::get('users', 'UsersController@userslist');	
	Route::get('users/adduser', 'UsersController@addeditUser');	
	Route::post('users/adduser', 'UsersController@addnew');	
	Route::get('users/adduser/{id}', 'UsersController@editUser');	
	Route::get('users/delete/{id}', 'UsersController@delete');
        Route::get('users/status/{id}/{status}', 'UsersController@users_status');

        Route::get('/teams','TeamController@team_page'); 
        Route::get('/teams/delete_team/{userid}','TeamController@delete_team'); 
        Route::get('/teams/members/{team_id}','TeamController@team_details');
        Route::get('/teams/delete_team_member/{id}/{uid}','TeamController@delete_team_member'); 
        
        Route::get('/invites','InviteController@invites_page'); 
        Route::get('/invites/delete_invite/{id}','InviteController@delete_invite');
        
        Route::get('/shortlists','ShortlistController@shortlist_page'); 
	Route::get('/shortlist/delete_shortlist/{id}','ShortlistController@delete_shortlist');
        Route::get('/conversation','InviteController@conversation'); 
        
        Route::get('/cities','CitiesController@cities'); 
        Route::post('/cities/addcity','CitiesController@add_city');
        Route::get('/cities/delete/{id}','CitiesController@city_delete');
        Route::get('/cities/status/{id}/{status}','CitiesController@cities_status');
        
        Route::get('/coupons','CouponsController@coupons'); 
        Route::post('/coupons/addcoupon','CouponsController@add_coupon');
        Route::get('/coupons/delete/{id}','CouponsController@coupon_delete');
        Route::get('/coupons/status/{id}/{status}','CouponsController@coupons_status');
        
        Route::get('/fieldsets','FieldsetsController@fieldsSets'); 
        Route::post('/fieldsets/addfieldset','FieldsetsController@add_fieldsSets');
        Route::get('/fieldsets/delete/{id}','FieldsetsController@fieldsSets_delete');
        
        //All filters
        Route::get('/userfilter', 'UsersController@user_filters'); 
        Route::get('/shortlistfilter', 'ShortlistController@shortlist_filters');
        Route::get('/teamsfilter', 'TeamController@teams_filters'); 
        Route::get('/invitefilters', 'InviteController@invite_filters');
        Route::get('/paymentfilters', 'IndexController@payment_filters');
        Route::get('/message_filters', 'InviteController@message_filters');
        

        Route::get('/payments', 'IndexController@payments');
        Route::get('/payments_refunds/{id}/{t_id}/{u_id}', 'IndexController@payments_refunds');
        
});
// Password reset link request routes...
/*Route::get('admin/password/email', 'Auth\PasswordController@getEmail');
Route::post('admin/password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('admin/password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('admin/password/reset', 'Auth\PasswordController@postReset');*/
Route::get('/', 'IndexController@index');
Route::get('about', 'IndexController@about_us');
Route::get('contact', 'IndexController@contact_us');
Route::post('contact_send', 'IndexController@contact_send');
Route::get('about', 'IndexController@about_us');
Route::get('termsandconditions', 'IndexController@termsandconditions');
Route::get('privacypolicy', 'IndexController@privacypolicy');

//Social Login
Route::get('social/login/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('social/login/callback/{provider}', 'Auth\AuthController@handleProviderCallback');
Route::get('login', 'IndexController@login');
Route::post('login', 'IndexController@postLogin');
Route::get('register', 'IndexController@register');
Route::post('register', 'IndexController@postRegister');
Route::get('/confirm/{confirm}', 'IndexController@confirmRegister'); 
// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('dashboard', 'IndexController@dashboard');
Route::get('profile', 'IndexController@profile');
Route::get('edit_profile', 'IndexController@ed_profile');
Route::post('profile', 'IndexController@editprofile');
Route::get('change_pass', 'IndexController@change_password');
Route::post('change_pass', 'IndexController@edit_password');
Route::get('logout', 'IndexController@logout');

/* search users */
Route::get('search', 'SearchController@searchpage'); 
Route::post('search/filters', 'SearchController@search_filter');
Route::get('search/filters', 'SearchController@search_filter'); 
Route::get('/setting','SearchController@setting_page'); 
Route::post('save_search_setting', 'SearchController@save_search_setting'); 
Route::get('users/save_actions', 'SearchController@save_actions'); 
 
Route::get('users/{id}/{token}', 'SearchController@veiw_profile'); 
Route::get('invites', 'InvitesController@invites_page'); 
Route::get('users/invite', 'InvitesController@user_invites'); 

Route::post('users/offer_message', 'InvitesController@offer_message'); 
Route::get('/shortlists', 'SearchController@shortlist_page');  
Route::get('users/save_shorlist_actions', 'InvitesController@save_shorlist_actions'); 

Route::get('users/send_message', 'InvitesController@send_message'); 
Route::get('users/load_messages', 'InvitesController@first_load_messages'); 

//Route::get('/conversation',function(){return view('pages.conversation'); }); 
Route::get('/conversation','IndexController@conversation'); 
Route::get('users/make_offer', 'InvitesController@make_offer'); 
Route::get('users/offer_recive_actions', 'InvitesController@offer_recive_actions'); 
Route::get('users/make_shorlist', 'InvitesController@make_shorlist'); 

Route::get('/teams/delete_team_member/{id}/{uid}','IndexController@delete_team_member'); 
Route::get('/teams/delete_team/{id}','IndexController@delete_teams'); 
Route::get('/teams/leave_team/{id}','IndexController@leave_team'); 

//Route::get('/subscription',function(){return view('pages.subscription'); }); 
Route::get('/subscription','IndexController@subscription'); 
Route::get('/stripe', 'IndexController@stripe');
Route::get('/copoun_apply', 'IndexController@copoun_apply');
/*Route::get('home', ['as' => 'home', 'uses' => function() {
	return view('home');
}]);*/

