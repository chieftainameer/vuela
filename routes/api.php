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


Route::group(['middleware' => ['auth:api'],'namespace' => 'api'] ,function () {
    Route::resource('roles', 'RoleController');
    Route::get('/user','UserController@verify');
});
Route::post('login','api\UserController@login');
