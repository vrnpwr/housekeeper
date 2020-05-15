<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('/user')->group( function() {

    // Login And Register
    Route::post('/login','api\admin\LoginController@login');
    Route::post('/register','api\admin\LoginController@register');

    // Password reset
    Route::post('reset_password_request', 'api\admin\PasswordResetController@create');
    Route::get('find_reset_token/{token}', 'api\admin\PasswordResetController@find');
    Route::post('reset_password', 'api\admin\PasswordResetController@reset');

    // Profile
    Route::post('account_type' , 'api\admin\ProfileController@account_type')->middleware('auth:api');
    Route::post('basic_info' , 'api\admin\ProfileController@basic_info')->middleware('auth:api');
    Route::post('address_info' , 'api\admin\ProfileController@address_info')->middleware('auth:api');
    Route::post('about_yourself' , 'api\admin\ProfileController@about_yourself')->middleware('auth:api');

    // Property
    Route::resource('property', 'api\admin\PropertyController')->middleware('auth:api');
    Route::post('property/imageUpload', 'api\admin\PropertyController@imageUpload');
    // view cleaner 
   
    // Route::get('/all', 'api\admin\user\LoginController@all')->middleware('auth:api');
});
