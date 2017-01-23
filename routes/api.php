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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// API
Route::group(['middleware' => ['auth:api'], 'prefix' => 'v1/'], function()
{
  Route::resource('users',          'Api\v1\UserController');
  Route::resource('books',          'Api\v1\BookController');
  Route::resource('book-units',     'Api\v1\BookUnitController');
  
  Route::get('books-in-hands/statistics',   [ 'as' => 'books-in-hand.statistics', 'uses' => 'Api\v1\BooksInHandController@statistics']);
  Route::get('books-in-hands/in-hand/{id}', [ 'as' => 'books-in-hand.in-hand',    'uses' => 'Api\v1\BooksInHandController@inHand']);
  Route::resource('books-in-hands', 'Api\v1\BooksInHandController');
});
