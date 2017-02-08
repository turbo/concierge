<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Routes for logged in user
Route::group(['middleware' => 'auth'], function () {
    Route::get('/groups', 'HomeController@getGroups');

    Route::get('/manage/{group_id}', 'HomeController@getManage');

    Route::post('/manage/{group_id}', ['before'=>'csrf', 'uses'=>'HomeController@postManage']);

    Route::post('/manage/{group_id}/renew', ['before'=>'csrf', 'uses'=>'HomeController@postRenew']);

    Route::post('/manage/{group_id}/terminate', ['before'=>'csrf', 'uses'=>'HomeController@postTerminate']);

    Route::get('/logout', 'HomeController@getLogout');

    Route::get('/password', 'HomeController@getPassword');

    Route::post('/password', ['before'=>'csrf', 'uses'=>'HomeController@postPassword']);
});

//Routes for site admin
Route::group(['before' => ['auth', 'admin']], function () {
    Route::get('/users', 'HomeController@getUsers');

    Route::post('/users', ['before'=>'csrf', 'uses'=>'HomeController@postUsers']);

    Route::get('/users/add', 'HomeController@getAddUser');

    Route::post('/users/add', ['before'=>'csrf', 'uses'=> 'HomeController@postAddUser']);

    Route::get('/user/{id}/edit', 'HomeController@getEditUser');

    Route::post('/user/{id}/edit', 'HomeController@postEditUser');
});

//Routes for non-logged in user
Route::group(['middleware' => 'guest'], function () {
    Route::get('/', 'HomeController@getIndex');

    Route::post('/signin', ['before'=>'csrf', 'uses'=>'HomeController@postSignin']);

    Route::post('/duologin', 'HomeController@postDuologin');
});

Route::get('/invite/{token}', 'HomeController@getInvite');