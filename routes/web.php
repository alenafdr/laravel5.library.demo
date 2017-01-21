<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'csrf'], function($router)
{
  
  // User
  Route::resource('user', 'UserController');

  // Book
  Route::resource('book', 'BookController');

  // BookUnit
  Route::resource('book-unit', 'BookUnitController');

  // BooksInHand
  Route::put('books-in-hand/return/{id}', [ 'as' => 'books-in-hand.return', 'uses' => 'BooksInHandController@bookreturn']);
  Route::resource('books-in-hand', 'BooksInHandController');
  
});

// API
Route::group(array('prefix' => 'api/v1'), function()
{
  Route::resource('books', 'Api\v1\BookController');
});