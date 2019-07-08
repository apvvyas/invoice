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

			Route::get('/profile', 'UserController@profile')->name('user.profile');	

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
			
			// Product Controls
			Route::prefix('products')->group(function () {
				Route::get('/','ProductController@index')->name('products');
				Route::get('/list','ProductController@list')->name('products.list');
				Route::get('/add','ProductController@create')->name('product.create');
				Route::post('/save','ProductController@store')->name('product.save');
				Route::get('/edit/{product}','ProductController@edit')->name('product.edit');
				Route::post('/update/{product}','ProductController@update')->name('product.update');
				Route::get('/details/{product}','ProductController@show')->name('product.show');
				Route::delete('/delete/{product}','ProductController@destroy')->name('product.destroy');
				Route::get('/dropdown','ProductController@autocomplete')->name('product.dropdown');
			});

			// Tax Controls
			Route::prefix('taxes')->group(function () {
				Route::get('/','TaxController@index')->name('taxes');
				Route::get('/list','TaxController@list')->name('taxes.list');
				Route::get('/add','TaxController@create')->name('tax.create');
				Route::post('/save','TaxController@store')->name('tax.save');
				Route::get('/edit/{tax}','TaxController@edit')->name('tax.edit');
				Route::post('/update/{tax}','TaxController@update')->name('tax.update');
				Route::delete('/delete/{tax}','TaxController@destroy')->name('tax.destroy');
			});

		});
		
	});
});
