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
    Route::post('/login','api\admin\LoginController@login');
    Route::post('/register','api\admin\LoginController@register');

    // Password reset

    Route::post('create', 'api\admin\PasswordResetController@create');
    Route::get('find/{token}', 'api\admin\PasswordResetController@find');
    Route::post('reset', 'api\admin\PasswordResetController@reset');

    // Route::get('/all', 'api\admin\user\LoginController@all')->middleware('auth:api');
});
