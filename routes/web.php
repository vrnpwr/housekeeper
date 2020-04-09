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

Route::get('/', function () { return redirect('/login'); });

Auth::routes();
// Dashboard
Route::get('/home', 'DashboardController@index')->name('index')->middleware('auth');
/*##############Property##############*/
Route::resource('/property','PropertyController')->middleware('auth');
Route::Post('/property/update', 'PropertyController@update_property')->middleware('auth');
Route::delete('/property/{id}', 'PropertyController@destroy')->middleware('auth');
Route::Post('/property/update/checklist', 'PropertyController@update_checklist')->middleware('auth');
/*###############Project###############*/
Route::resource('/project','ProjectController')->middleware('auth');
Route::get('/project/{id}/editproject','ProjectController@edit_project')->middleware('auth');
Route::Post('/project/update', 'ProjectController@update_project')->middleware('auth');
Route::delete('/project/{id}', 'ProjectController@destroy')->middleware('auth');

/*###############Schedule###############*/
Route::resource('/schedule','ScheduleController')->middleware('auth');
// Route::Post('/project/update', 'ScheduleController@update_project')->middleware('auth');
Route::delete('/project/{id}', 'ScheduleController@destroy')->middleware('auth');
Route::get('showcalendar','ScheduleController@show_calendar');
Route::post('viewcalendar','ScheduleController@get_calendar_detail');

/* ##############CheckList##############*/
Route::resource('/mychecklists','CheckListController')->middleware('auth');
Route::Post('/mychecklists/update', 'CheckListController@update_checklist')->middleware('auth');
Route::delete('/mychecklists/{id}', 'CheckListController@destroy')->middleware('auth');

//Filepond Image
Route::get('/filepond/uploadImage','FilePondController@uploadImage')->middleware('auth');
Route::delete('/filepond/deleteImage','FilePondController@deleteImage')->middleware('auth');


/*########################## PROFILE ########################*/

Route::resource('/profile','ProfileController')->middleware('auth');
Route::post('/profile/checkOldPassword','ProfileController@checkOldPassword')->middleware();
Route::post('/profile/deleteImage','ProfileController@deleteImage')->middleware();

/*########################## Notification ########################*/
Route::resource('/notification','NotificationController')->middleware('auth');

/* ####################### PROJECT SETTINGS ####################### */
Route::resource('/project-settings','ProjectSettingController')->middleware('auth');

/*########################## Teams Route ########################*/
/*Invite*/
Route::resource('/invite','InviteController')->middleware('auth');

/* Cleaner */
Route::resource('/cleaner', 'CleanerController')->middleware('auth');

/*################ TESTING ROUTES #################*/

/*Password Reset */
Route::get('change-password', 'ChangePasswordController@index')->middleware('auth');

Route::post('change-password', 'ChangePasswordController@store')->name('change.password')->middleware('auth');



//fullcalender For Testing Only
Route::get('fullcalendar','FullCalendarController@index');
Route::post('fullcalendar/create','FullCalendarController@create');
Route::post('fullcalendar/update','FullCalendarController@update');
Route::post('fullcalendar/delete','FullCalendarController@destroy');



Route::get('testfilepond',function(){
	return view('filepond');
});


/*################ TESTING ROUTES #################*/