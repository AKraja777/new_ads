<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api\V1', 'middleware' => 'localization'], function () {



    //shangrilla web api's

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', 'SettingController@get_settings');
    });

    Route::post('/signup', 'UserController@Signup');
    Route::post('/register', 'UserController@Register');
    Route::post('/userdetails', 'UserController@user_details');
    Route::post('/update_profile', 'UserController@update_profile');
    Route::post('login','UserController@login');
    Route::post('/comment','UserController@Comment');
    Route::post('/app_update','UserController@app_update');
    Route::post('/update_course','UserController@update_course');
    Route::post('/course_list','UserController@course_list');
    Route::post('/my_course_list','UserController@my_course_list');
    Route::post('/session_list','UserController@session_list');
    Route::post('/add_categories','UserController@add_categories');
     Route::post('/upload_image','UserController@upload_image');


    Route::group(['prefix' => 'booklist'], function () {
        Route::post('/searchbooks', 'UserController@Searchbook');
        Route::post('/add-cart','UserController@add_cart');
        Route::post('/delete-cart','UserController@delete_cart');
    
    });

});
