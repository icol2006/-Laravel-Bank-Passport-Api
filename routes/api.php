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
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@saveUser');
    Route::get('logout', 'AuthController@logout');
});

Route::group([
    'middleware' => ['auth:api','AccountOwner']
], function() {
    Route::get('user', 'AuthController@user');
    Route::get('test', 'AuthController@test');   

    Route::prefix('account')->group(function () {
        Route::get('/', 'AccountsController@getall');
        Route::get('/{account}', 'AccountsController@getById');
        Route::post('/', 'AccountsController@save');
        Route::get('/{account}/movements', 'AccountsMovementsController@getAllByAccountId');
        Route::post('/{account}/movements', 'AccountsMovementsController@save');
    });

});