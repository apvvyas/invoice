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

Route::namespace('Admin')->group(function () {
	Route::get('welcome-user/preview/{user}','UserController@previewWelcomeMail')->name('welcome-preview');

});


Route::group(['middleware' => 'auth'], function () {
	Route::prefix('admin')->group(function () {
		Route::get('/', 'HomeController@index')->name('home');	


		Route::namespace('Admin')->group(function () {

			Route::get('/profile', 'UserController@profile')->name('user.profile');	
			Route::post('/profile/save', 'UserController@profileSave')->name('user.profile.save');	
			Route::post('/tour-complete', 'UserController@tourComplete')->name('user.tour.complete');	

			Route::group(['middleware' => ['profile']], function () {
				//Invoice Controls
				Route::prefix('invoice')->group(function () {

					Route::group(['middleware' => ['permission:view_invoice']], function () {
						Route::get('/','InvoiceController@index')->name('invoices');
						Route::get('/list','InvoiceController@list')->name('invoices.list');
						Route::get('/details/{invoice}','InvoiceController@show')->name('invoice.show');
					});
					
					Route::group(['middleware' => ['permission:add_invoice']], function () {
						Route::get('/add','InvoiceController@create')->name('invoice.create');
						Route::post('/save','InvoiceController@store')->name('invoice.save');
					});
					
					Route::group(['middleware' => ['permission:add_recipient|view_recipient']], function () {
						Route::get('/add/recipient/list','RecipientController@list_for_invoice')->name('user.recipient.list');
						Route::post('/recipient/save','RecipientController@store')->name('user.recipient.add');
					});
					
					Route::group(['middleware' => ['permission:delete_invoice']], function () {
						Route::delete('/delete/{invoice}','InvoiceController@destroy')->name('invoice.destroy');
						Route::get('/status/{invoice}','InvoiceController@status')->name('invoice.status');
						Route::post('/send/{invoice}','InvoiceController@send')->name('invoice.send');
					});
					Route::group(['middleware' => ['permission:export_invoice']], function () {
						Route::get('/details/{invoice}/pdf','InvoiceController@pdf')->name('invoice.pdf');
					});
					
				});

				//User Controls
				Route::prefix('users')->group(function () {

					Route::group(['middleware' => ['permission:view_user']], function () {
						Route::get('/','UserController@index')->name('users');
						Route::get('/list','UserController@list')->name('users.list');
						Route::get('/details/{user}','UserController@show')->name('user.show');
					});

					Route::group(['middleware' => ['permission:add_user']], function () {
						Route::get('/add','UserController@create')->name('user.create');
						Route::post('/save','UserController@store')->name('user.save');
					});
					
					Route::group(['middleware' => ['permission:add_user']], function () {
						Route::get('/edit/{user}','UserController@edit')->name('user.edit');
						Route::post('/update/{user}','UserController@update')->name('user.update');
					});
					
					Route::group(['middleware' => ['permission:delete_user']], function () {
						Route::delete('/delete/{user}','UserController@destroy')->name('user.destroy');
					});	
				});

				//Recipient Controls
				Route::prefix('recipients')->group(function () {
					Route::group(['middleware' => ['permission:view_recipient']], function () {
						Route::get('/','RecipientController@index')->name('recipients');
						Route::get('/list','RecipientController@list')->name('recipients.list');
						Route::get('/details/{recipient}','RecipientController@show')->name('recipient.show');
					});
					
					Route::group(['middleware' => ['permission:add_recipient']], function () {
						Route::get('/add','RecipientController@create')->name('recipient.create');
						Route::post('/save','RecipientController@store')->name('recipient.save');
					});
					
					Route::group(['middleware' => ['permission:edit_recipient']], function () {
						Route::get('/edit/{recipient}','RecipientController@edit')->name('recipient.edit');
						Route::post('/update/{recipient}','RecipientController@update')->name('recipient.update');
					});
					
					Route::group(['middleware' => ['permission:delete_recipient']], function () {
						Route::delete('/delete/{recipient}','RecipientController@destroy')->name('recipient.destroy');
					});
				});
				
				// Product Controls
				Route::prefix('products')->group(function () {
					Route::group(['middleware' => ['permission:view_product']], function () {
						Route::get('/','ProductController@index')->name('products');
						Route::get('/list','ProductController@list')->name('products.list');
						Route::get('/details/{product}','ProductController@show')->name('product.show');
						Route::get('/dropdown','ProductController@autocomplete')->name('product.dropdown');
					});
					
					Route::group(['middleware' => ['permission:add_product']], function () {
						Route::get('/add','ProductController@create')->name('product.create');
						Route::post('/save','ProductController@store')->name('product.save');
					});
					Route::group(['middleware' => ['permission:edit_product']], function () {
						Route::get('/edit/{product}','ProductController@edit')->name('product.edit');
						Route::post('/update/{product}','ProductController@update')->name('product.update');
					});
					
					Route::group(['middleware' => ['permission:delete_product']], function () {
						Route::delete('/delete/{product}','ProductController@destroy')->name('product.destroy');
					});

				});

				// Tax Controls
				Route::prefix('taxes')->group(function () {

					Route::group(['middleware' => ['permission:view_tax']], function () {
						Route::get('/','TaxController@index')->name('taxes');
						Route::get('/list','TaxController@list')->name('taxes.list');
					});

					Route::group(['middleware' => ['permission:add_tax']], function () {
						Route::get('/add','TaxController@create')->name('tax.create');
						Route::post('/save','TaxController@store')->name('tax.save');
					});
					Route::group(['middleware' => ['permission:edit_tax']], function () {
						Route::get('/edit/{tax}','TaxController@edit')->name('tax.edit');
						Route::post('/update/{tax}','TaxController@update')->name('tax.update');
					});
					
					Route::group(['middleware' => ['permission:delete_tax']], function () {
						Route::delete('/delete/{tax}','TaxController@destroy')->name('tax.destroy');
					});	
				});


				// ContactUs Controls
				Route::prefix('contacts')->group(function () {

					Route::group(['middleware' => ['permission:view_contact']], function () {
						Route::get('/','ContactUsController@index')->name('contacts');
						Route::get('/list','ContactUsController@list')->name('contacts.list');
					});

					Route::group(['middleware' => ['permission:add_contact']], function () {
						Route::get('/add','ContactUsController@create')->name('contact.create');
						Route::post('/save','ContactUsController@store')->name('contact.save');
					});
					Route::group(['middleware' => ['permission:edit_contact']], function () {
						Route::get('/edit/{contact}','ContactUsController@edit')->name('contact.edit');
						Route::post('/update/{contact}','ContactUsController@update')->name('contact.update');
					});
					
					Route::group(['middleware' => ['permission:delete_contact']], function () {
						Route::delete('/delete/{contact}','ContactUsController@destroy')->name('contact.destroy');
					});	
				});

				// ContactUs Controls
				Route::prefix('todos')->group(function () {

					Route::group(['middleware' => ['permission:view_todo']], function () {
						Route::get('/','TodoController@index')->name('todos');
						Route::get('/list','TodoController@list')->name('todos.list');
					});

					Route::group(['middleware' => ['permission:add_todo']], function () {
						Route::get('/add','TodoController@create')->name('todo.create');
						Route::post('/save','TodoController@store')->name('todo.save');
					});
					Route::group(['middleware' => ['permission:edit_todo']], function () {
						Route::get('/edit/{todo}','TodoController@edit')->name('todo.edit');
						Route::post('/update/{todo}','TodoController@update')->name('todo.update');
						Route::post('/checkoff/{todo}','TodoController@checkoff')->name('todo.checkoff');
					});
					
					Route::group(['middleware' => ['permission:delete_todo']], function () {
						Route::delete('/delete/{todo}','TodoController@destroy')->name('todo.destroy');
					});	
				});
			});

		});
		
	});
});
