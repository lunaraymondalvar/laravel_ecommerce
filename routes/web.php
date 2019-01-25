<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/catalog', "ItemController@showItems"); 
Route::get('/menu/mycart', "ItemController@showCart");
Route::delete('/menu/mycart/{id}/delete', "ItemController@deleteCart");
Route::get('/menu/clearcart', "ItemController@clearCart");
Route::patch('/menu/mycart/{id}/changeQty', "ItemController@updateCart");
Route::post('/addToCart/{id}', "ItemController@addToCart");
Route::get('/menu/categories/{id}', "CategoryController@findItems");


Route::middleware('auth')->group(function () {
	Route::get('/menu/add', "ItemController@showAddItemForm");
	Route::post('/menu/add', "ItemController@saveItems");
	Route::get('/menu/{id}', "ItemController@itemDetails"); 
	Route::delete("/menu/{id}/delete", "ItemController@deleteItem");
	Route::get('/menu/{id}/edit', "ItemController@showEditForm");
	Route::patch('/menu/{id}/edit', "ItemController@editItem");

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
