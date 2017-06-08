<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'v0', 'as' => 'api.v0.', 'namespace' => 'Api'], function () {
    Route::get('home', ['as' => 'home', 'uses' => 'HomeController@index']);
    Route::post('home/filters', ['as' => 'homeFilters', 'uses' => 'HomeController@filter']);

    Route::group(['namespace' => 'Auth'], function () {
        Route::post('register', ['as' => 'register', 'uses' => 'RegisterController@create']);
        Route::post('login', ['as' => 'login', 'uses' => 'LoginController@login']);
        Route::post('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);
    });

    Route::get('books/condition-sort', 'BookController@loadConditionSort');
    Route::resource('books', 'BookController', [
        'except' => ['store']
    ]);
    Route::post('books/filters', ['as' => 'books.filters', 'uses' => 'BookController@filter']);
    Route::post('search', ['as' => 'search', 'uses' => 'BookController@search']);
    Route::resource('categories', 'CategoryController', [
        'only' => ['index']
    ]);
    Route::resource('offices', 'OfficeController', [
        'only' => ['index']
    ]);

    Route::group(['middleware' => 'fapi'], function () {
        Route::resource('user', 'UserController');
        Route::get('users/waiting-book', ['as' => 'users.waitingBook', 'uses' => 'UserController@waiting']);
        Route::post('books/review/{book_id}', ['as' => 'books.review', 'uses' => 'BookController@review']);
        Route::post('books/booking/{book_id}', ['as' => 'books.booking', 'uses' => 'BookController@booking']);
        Route::resource('books', 'BookController', [
            'only' => ['store']
        ]);
    });
});
