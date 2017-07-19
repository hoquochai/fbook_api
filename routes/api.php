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

    Route::get('books/sort-by', 'BookController@sortBy');
    Route::resource('books', 'BookController', [
        'except' => ['store', 'update', 'destroy']
    ]);
    Route::get('books/{id}/increase-view', ['as' => 'books.increaseView', 'uses' => 'BookController@increaseView']);
    Route::post('books/filters', ['as' => 'books.filters', 'uses' => 'BookController@filter']);
    Route::get('books/category/{category_id}', ['as' => 'books.category', 'uses' => 'BookController@category']);
    Route::get('books/office/{office_id}', ['as' => 'books.office', 'uses' => 'BookController@office']);
    Route::post('books/category/{category_id}/filter', ['as' => 'books.category.filter', 'uses' => 'BookController@filterCategory']);
    Route::post('search', ['as' => 'search', 'uses' => 'BookController@search']);
    Route::resource('categories', 'CategoryController', [
        'only' => ['index']
    ]);
    Route::resource('offices', 'OfficeController', [
        'only' => ['index']
    ]);

    Route::get('search-books', 'SearchController@search');

    Route::get('search-books-detail/{book_id}', 'SearchController@detail');

    Route::group(['middleware' => 'fapi'], function () {
        Route::get('user-profile', ['as' => 'user.profile', 'uses' => 'UserController@getUserFromToken']);
        Route::get('user/books/waiting_approve', ['as' => 'user.books.waiting-approve', 'uses' => 'UserController@getListWaitingApprove']);
        Route::get('user/{book_id}/approve/detail', ['as' => 'user.books.approve.detail', 'uses' => 'UserController@getBookApproveDetail']);
        Route::post('users/add-tags', ['as' => 'user.add.tags', 'uses' => 'UserController@addTags']);
        Route::get('users/interested-books', ['as' => 'user.interested.books', 'uses' => 'UserController@getInterestedBooks']);
        Route::resource('users', 'UserController');
        Route::get('users/book/{id}/{action}', ['as' => 'users.book', 'uses' => 'UserController@getBook']);
        Route::post('books/review/{book_id}', ['as' => 'books.review', 'uses' => 'BookController@review']);
        Route::post('books/booking', ['as' => 'books.booking', 'uses' => 'BookController@booking']);
        Route::post('books/approve/{book_id}', ['as' => 'books.approve', 'uses' => 'BookController@approve']);
        Route::get('users/books/owned', ['as' => 'users.books.owned', 'uses' => 'UserController@ownedBooks']);
        Route::resource('books', 'BookController', [
            'only' => ['store', 'update', 'destroy']
        ]);
        Route::get('books/add-owner/{book_id}', ['as' => 'books.add-owner', 'uses' => 'BookController@addOwner']);
        Route::post('books/upload-media', ['as' => 'books.uploadMedia', 'uses' => 'BookController@uploadMedia']);
    });
});
