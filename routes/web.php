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
				Route::get('/list','InvoiceController@list')->name('invoices.list');
				Route::get('/add','InvoiceController@create')->name('invoice.create');
				Route::get('/add/recipient/list','RecipientController@list_for_invoice')->name('user.recipient.list');
				Route::post('/recipient/save','RecipientController@store')->name('user.recipient.add');
				Route::post('/save','InvoiceController@store')->name('invoice.save');

				Route::get('/details/{invoice}','InvoiceController@show')->name('invoice.show');
				Route::delete('/delete/{invoice}','InvoiceController@destroy')->name('invoice.destroy');

				Route::get('/details/{invoice}/pdf','InvoiceController@pdf')->name('invoice.pdf');
			});

			//User Controls
			Route::prefix('users')->group(function () {
				Route::get('/','UserController@index')->name('users');
				Route::get('/list','UserController@list')->name('users.list');
				Route::get('/add','UserController@create')->name('user.create');
				Route::post('/save','UserController@store')->name('user.save');
				Route::get('/edit/{user}','UserController@edit')->name('user.edit');
				Route::post('/update/{user}','UserController@update')->name('user.update');
				Route::get('/details/{user}','UserController@show')->name('user.show');
				Route::delete('/delete/{user}','UserController@destroy')->name('user.destroy');
			});

			//Recipient Controls
			Route::prefix('recipients')->group(function () {
				Route::get('/','RecipientController@index')->name('recipients');
				Route::get('/list','RecipientController@list')->name('recipients.list');
				Route::get('/add','RecipientController@create')->name('recipient.create');
				Route::post('/save','RecipientController@store')->name('recipient.save');
				Route::get('/edit/{recipient}','RecipientController@edit')->name('recipient.edit');
				Route::post('/update/{recipient}','RecipientController@update')->name('recipient.update');
				Route::get('/details/{recipient}','RecipientController@show')->name('recipient.show');
				Route::delete('/delete/{recipient}','RecipientController@destroy')->name('recipient.destroy');
			});
			

		});
		
	});
});
