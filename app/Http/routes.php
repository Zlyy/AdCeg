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
    
    
    Route::get('adverts/owned', 'AdvertsController@owned');
    Route::get('adverts/create', 'AdvertsController@create');
    Route::put('adverts/{id}', 'AdvertsController@update');
    Route::patch('adverts/{id}', 'AdvertsController@update');
    Route::post('adverts', 'AdvertsController@store');
    Route::get('adverts/{id}/edit', 'AdvertsController@edit');
    
    Route::delete('adverts/{id}', ['as' => 'advert.destroy', 'uses' => 'AdvertsController@destroy']);
    
    
    
    Route::get('adverts', 'AdvertsController@index');
    Route::get('adverts/{id}', 'AdvertsController@show');
    

    Route::get('/user/edit/{id}', 'UserController@edit');
    Route::put('/user/edit/{id}', 'UserController@update');
    Route::patch('/user/edit/{id}', 'UserController@update');
    
    Route::get('user/edit/password/{id}', 'UserController@editPassword');
    Route::put('user/edit/password/{id}', 'UserController@updatePassword');
    Route::patch('user/edit/password/{id}', 'UserController@updatePassword');
    
   
    
    
    Route::get('/user/show', 'UserController@show');
    
    
});




//Route::group(['middleware' => 'web'], function () {
//    Route::auth();
//    Route::get('/home', 'HomeController@index');
//});
