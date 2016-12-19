<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('home');
//})->name('home');

Route::get('/', [
        'uses' => 'NiceActionController@getHome',
        'as' => 'home'
]);


//Laravel's route grouping. We add a prefix that will be used in all the routes inside our function

Route::group(['prefix' => 'do'], function(){


    Route::get('/{action}/{name?}', [
//        Will tell laravel which controller and which action will take care of this route
        'uses' => 'NiceActionController@getNiceAction',
//        Naming the route, same as " ->name('name') "
        'as' => 'niceaction'
    ]);



//Access all data sent using this post request. We need to specified the path (Standard Laravel Object).
    Route::post('/add_action', [
//        Tell Laravel to use our controller and function
        'uses' => 'NiceActionController@postInsertNiceAction',
        'as' => 'add_action'
    ]);

});
