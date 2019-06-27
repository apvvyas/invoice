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

Auth::routes();


Route::group(['middleware' => 'auth'], function () {
	Route::prefix('admin')->group(function () {
		Route::get('/', 'HomeController@index')->name('home');	

		Route::namespace('Admin')->group(function () {

			//Invoice Controls
			Route::prefix('invoice')->group(function () {
				Route::get('/','InvoiceController@index')->name('invoices');
				Route::get('/add','InvoiceController@create')->name('invoice_create');
				Route::get('/add/recipient/list','RecipientController@list_for_invoice')->name('user_recipient_list');
				Route::post('/recipient/save','RecipientController@store')->name('user_recipient_add');
			});
			

		});
		
	});
});
