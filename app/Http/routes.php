<?php

/*
  |--------------------------------------------------------------------------
  | Routes File
  |--------------------------------------------------------------------------
  |
  | Here is where you will register all of the routes in an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */



/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | This route group applies the "web" middleware group to every route
  | it contains. The "web" middleware group is defined in your HTTP
  | kernel and includes session state, CSRF protection, and more.
  |
 */

Route::get('profile', ['middleware' => 'auth', function() {
        return 'tylko dla zalogowanych';
    }]);


Route::group(['middleware' => ['web']], function () {
    Route::auth();
    Route::get('', 'AdvertsController@home');

    Route::get('user/{id}/owned', 'AdvertsController@showUsersAds');
    Route::get('adverts/owned', 'AdvertsController@owned');
    Route::get('adverts/create', 'AdvertsController@create');
    Route::put('adverts/{id}', 'AdvertsController@update');
    Route::patch('adverts/{id}', 'AdvertsController@update');
    Route::post('adverts', 'AdvertsController@store');
    Route::get('adverts/{id}/edit', 'AdvertsController@edit');


    Route::delete('adverts/{id}', ['as' => 'advert.destroy', 'uses' => 'AdvertsController@destroy']);
    Route::delete('user/delete/{id}', ['as' => 'user.destroy', 'uses' => 'UserController@destroy']);
    Route::delete('tags/{name}', ['as' => 'tags.destroy', 'uses' => 'TagsController@destroy']);
    
    Route::post('admin/users/give/{id}', ['as' => 'admin.give', 'uses' => 'UserController@giveAdmin']);
    Route::post('admin/users/take/{id}', ['as' => 'admin.take', 'uses' => 'UserController@takeAdmin']);

    Route::get('tags/{tags}', 'TagsController@show');

    Route::get('adverts', 'AdvertsController@index');
    Route::get('adverts/{id}', 'AdvertsController@show');


    Route::get('/user/edit/{id}', 'UserController@edit');
    Route::put('/user/edit/{id}', 'UserController@update');
    Route::patch('/user/edit/{id}', 'UserController@update');

    Route::get('user/edit/password/{id}', 'UserController@editPassword');
    Route::put('user/edit/password/{id}', 'UserController@updatePassword');
    Route::patch('user/edit/password/{id}', 'UserController@updatePassword');




    Route::get('/user/show', 'UserController@show');
    Route::get('/admin/tags', 'TagsController@adminTags');

    Route::get('/admin/users', 'UserController@adminIndex');
    Route::get('/admin/adverts', 'AdvertsController@adminAdverts');

    Route::get('contact', ['as' => 'contact', 'uses' => 'ContactController@create']);
    Route::post('contact', ['as' => 'contact_store', 'uses' => 'ContactController@store']);
    
    Route::post('/adverts/message', ['as' => 'contact_advert_store', 'uses' => 'ContactController@advertStore']);
//    Route::get('/adverts/{id}', ['as' => 'contact_advert', 'uses' => 'ContactController@advertStore']);
    
    Route::post('/search/', 'AdvertsController@searchAdverts');
    //Route::get('/search/', 'AdvertController@searchAdverts');  
    
    Route::patch('adverts/expired/{id}', ['as' => 'advert.setExpired', 'uses' => 'AdvertsController@setExpired']);
    Route::patch('adverts/available/{id}', ['as' => 'advert.setAvailable', 'uses' => 'AdvertsController@setAvailable']);
});




//Route::group(['middleware' => 'web'], function () {
//    Route::auth();
//    Route::get('/home', 'HomeController@index');
//});
