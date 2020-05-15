<?php

use Illuminate\Support\Facades\Route;

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
	});

		// Cleaner group routes
		Route::group(['middleware' => ['cleaner'] , 'prefix' => 'cleaner'], function () {		
		Route::resource('/dashboard' , 'cleaner\DashboardController');
		Route::resource('/job' , 'cleaner\CleanerJobController');

		/*########################## PROFILE ########################*/			
		Route::resource('/profile','cleaner\ProfileController');
		Route::post('/profile/checkOldPassword','cleaner\ProfileController@checkOldPassword');
		Route::post('/profile/deleteImage','cleaner\ProfileController@deleteImage');
		
		/*########################## Notification ########################*/
		Route::resource('/notification','cleaner\NotificationController');

	});

	// Host group routes
	Route::group(['middleware' => ['host'] ], function () {
			/*##############Property##############*/
			Route::get('/home', 'DashboardController@index')->name('home');
			Route::resource('/property','PropertyController');
			Route::Post('/property/update', 'PropertyController@update_property');
			Route::delete('/property/{id}', 'PropertyController@destroy');
			Route::Post('/property/update/checklist', 'PropertyController@update_checklist');
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
			Route::resource('/mychecklists','CheckListController');
			Route::Post('/mychecklists/update', 'CheckListController@update_checklist');
			Route::delete('/mychecklists/{id}', 'CheckListController@destroy');			
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
			
			/* Cleaner */
			Route::resource('/cleaner', 'CleanerController');
			
			/*################ TESTING ROUTES #################*/
			
			/*Password Reset */
			Route::get('change-password', 'ChangePasswordController@index');
			
			Route::post('change-password', 'ChangePasswordController@store')->name('change.password');
			
			
			
			//fullcalender For Testing Only
			Route::get('fullcalendar','FullCalendarController@index');
			Route::post('fullcalendar/create','FullCalendarController@create');
			Route::post('fullcalendar/update','FullCalendarController@update');
			Route::post('fullcalendar/delete','FullCalendarController@destroy');		
			
			
			Route::get('testfilepond',function(){
				return view('filepond');
			});
		
		// Dashboard
		// Route::get('/home', 'DashboardController@index')->name('index');

		
	});
	// Host group ends
	
});


/*################ TESTING ROUTES #################*/