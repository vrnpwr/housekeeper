<?php

use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// *using toMail method

use Illuminate\Support\Facades\Notification;
use App\Notifications\NewMessage;

// we have 3 middleware ['host','superadmin','cleaner']

Route::get('/', function () { return redirect('/login'); });

Route::group(['middleware' => 'web'], function() {	
	Auth::routes();
		// After login check which type of user login
		Route::get('/check', function(){
			$user = \Auth::user();
			if (isset($user) && $user->type == 'SuperAdmin') {
				return redirect('admin/dashboard');
			} 
			elseif(isset($user) && $user->type == 'host') {
				return redirect()->route('home');
			}
			elseif(isset($user) && $user->type == 'cleaner') {
				return redirect('cleaner/dashboard');
			}
			else{
				return Route::get('/usertypenotfound', function(){
					return abort(404);
				});
			}
		});
		
	// Super admin group routes
	Route::group(['middleware' => ['superadmin'] , 'prefix' => 'admin'], function () {		
		Route::resource('/dashboard' , 'admin\DashboardController');
		Route::get('/host/view' , 'admin\AdminInformationController@view_hosts');
		Route::get('/cleaner/view' , 'admin\AdminInformationController@view_cleaners');
		Route::get('/property/view' , 'admin\AdminInformationController@view_properties');
		// ######################### Cleaner Details ####################
		Route::get('/cleaner/details/{id}' , 'admin\CleanerDetailController@cleaner_details');
		// Approve Cleaner 
		Route::post('/approve_cleaner' , 'admin\ActionController@approve_cleaner');
		Route::post('/disapprove_cleaner' , 'admin\ActionController@disapprove_cleaner');
		// ######################### Setttings ##########################
		//  Profile 
		Route::resource('/profile','admin\ProfileController');
		Route::post('/profile/checkOldPassword','admin\ProfileController@checkOldPassword');
		Route::post('/profile/deleteImage','admin\ProfileController@deleteImage');
		//  Setttings

		//  FilePond 
		Route::get('/filepond/uploadImage','FilePondController@uploadImage');
		Route::delete('/filepond/deleteImage','FilePondController@deleteImage');			
	});
	
	// Cleaner group routes
	Route::group(['middleware' => ['cleaner'] , 'prefix' => 'cleaner'], function () {
		Route::resource('/dashboard' , 'cleaner\DashboardController');
		Route::resource('/myjobs' , 'cleaner\CleanerJobController');

		Route::resource('/invites' , 'cleaner\CleanerInvitationController');
		// Change invitation status
		Route::post('/invite/change' , 'cleaner\CleanerInvitationController@change_invite_status');
		// Notification readAt
		Route::post('/notificationReadAt' , 'cleaner\CleanerInvitationController@notificationReadAt');
			/*########################## PROFILE ########################*/			
		Route::resource('/profile','cleaner\ProfileController');
		Route::post('/profile/checkOldPassword','cleaner\ProfileController@checkOldPassword');
		Route::post('/profile/deleteImage','cleaner\ProfileController@deleteImage');
		
			/*########################## Notification ########################*/
			Route::resource('/notification','cleaner\NotificationController');
			// ######################### FilePond ############################
			Route::get('/filepond/uploadImage','FilePondController@uploadImage');
			Route::delete('/filepond/deleteImage','FilePondController@deleteImage');	
			// ###################### Reviews ################################
			Route::resource('/reviews','cleaner\ReviewsController');
			Route::resource('/information' ,'cleaner\cleanerInformationController');
			
			Route::get('/address' , 'cleaner\cleanerInformationController@address');
			Route::post('/address/create' , 'cleaner\cleanerInformationController@address_create');

			// Profile photo upload
			Route::get('/profile_photo' , 'cleaner\cleanerInformationController@profile_photo');
			Route::post('/profile_photo/create' , 'cleaner\cleanerInformationController@profile_photo_create');

			Route::get('/identity' ,'cleaner\cleanerInformationController@identity');
			Route::post('/identity/create' ,'cleaner\cleanerInformationController@identity_create');

			Route::get('/reference' , 'cleaner\cleanerInformationController@reference');
			Route::post('/reference/create' , 'cleaner\cleanerInformationController@reference_create');
			// ##################### Customers ###############################
			Route::resource('/customers','cleaner\customersController');
			// Notification Manager ##############################
			Route::resource('/fetchNotifications' , 'cleaner\NotificationManager');
			Route::get('/session' ,'cleaner\TestController@session');
			// Session testing

	});

	// <a href="{{ url('cleaner/address') }}" class="btn btn-danger d-inline">Step 2</a>

	// Host group routes
	Route::group(['middleware' => ['host'] ], function () {
			/*##############Property##############*/
			Route::get('/dashboard', 'DashboardController@index')->name('home');
			Route::resource('/property','PropertyController');
			Route::Post('/property/update', 'PropertyController@update_property');
			Route::delete('/property/{id}', 'PropertyController@destroy');
			Route::Post('/property/update/checklist', 'PropertyController@update_checklist');
			/* #################### Get Location #####################*/
			Route::post('/property/getlocation' , 'PropertyController@showAddress');
			/*###############Project###############*/
			Route::resource('/project','ProjectController');
			Route::get('/project/{id}/editproject','ProjectController@edit_project');
			Route::Post('/project/update', 'ProjectController@update_project');
			Route::delete('/project/{id}', 'ProjectController@destroy');			
			/*###############Schedule###############*/
			Route::resource('/schedule','ScheduleController');
			// Route::Post('/project/update', 'ScheduleController@update_project');
			Route::delete('/project/{id}', 'ScheduleController@destroy');
			Route::get('showcalendar','ScheduleController@show_calendar');
			Route::post('viewcalendar','ScheduleController@get_calendar_detail');			
			/* ##############CheckList##############*/
			// Route::resource('/mychecklists','CheckListController');
			// Route::Post('/mychecklists/update', 'CheckListController@update_checklist');
			// Route::delete('/mychecklists/{id}', 'CheckListController@destroy');			
			//Filepond Image
			Route::get('/filepond/uploadImage','FilePondController@uploadImage');
			Route::delete('/filepond/deleteImage','FilePondController@deleteImage');			
			
			/*########################## PROFILE ########################*/			
			Route::resource('/profile','ProfileController');
			Route::post('/profile/checkOldPassword','ProfileController@checkOldPassword');
			Route::post('/profile/deleteImage','ProfileController@deleteImage');
			
			/*########################## Notification ########################*/
			Route::resource('/notification','NotificationController');
			
			/* ####################### PROJECT SETTINGS ####################### */
			Route::resource('/project-settings','ProjectSettingController');
			
			/*########################## Teams Route ########################*/
			/*Invite*/
			Route::resource('/invite','InviteController');
			Route::delete('/invite/{id}','InviteController@destroy');
			Route::get('/invite/resent/{id}','InviteController@resent');
			
			/* Cleaner */
			Route::resource('/cleaner', 'CleanerController');
			// Available Cleaners
			Route::get('/available_cleaners' , 'CleanerController@availabeCleaners');
			/*################ TESTING ROUTES #################*/
			
			/*Password Reset */
			Route::get('change-password', 'ChangePasswordController@index');
			
			Route::post('change-password', 'ChangePasswordController@store')->name('change.password');
			
			
			
			//fullcalender For Testing Only
			Route::get('fullcalendar','FullCalendarController@index');
			Route::post('fullcalendar/create','FullCalendarController@create');
			Route::post('fullcalendar/update','FullCalendarController@update');
			Route::post('fullcalendar/delete','FullCalendarController@destroy');		
			
			// Testing Routes ##################################################
			Route::get('testfilepond',function(){
				return view('filepond');
			});

			Route::get('testmail',function() {
				$details = [
					'title' => "This is Tiltle",
					'body' => "This is body"
				];
				\Mail::to('vrnpwr001@gmail.com')->send(new App\Mail\TestMail($details));
				dd("Mail sent");
			});

			// To mail method Route testing
			Route::get('/toMail', function (){
				$details['app_name'] = "HouseKeeper";
				Notification::route('mail', 'vrnpwr001@gmail.com')->notify(new NewMessage($details));
				return 'Sent';
		});
		
		// Dashboard
		// Route::get('/home', 'DashboardController@index')->name('index');

		
	});
	// Host group ends
	
});


/*################ TESTING ROUTES #################*/