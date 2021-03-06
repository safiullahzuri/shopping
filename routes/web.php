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

Route::get('/invoice/thisYear', 'InvoiceController@thisYear')->name('invoice.thisYear');

Route::get('/invoice/thisMonth', 'InvoiceController@thisMonth')->name('invoice.thisMonth');

Route::get('/invoice/today', 'InvoiceController@today')->name('invoice.today');
Route::get('/invoice/thisWeek', 'InvoiceController@thisWeek')->name('invoice.thisWeek');
Route::get('/invoice/show/{id}', 'InvoiceController@show')->name('invoice.show');

Route::get('/invoice', 'InvoiceController@index')->name('invoice.store');

Route::get('/invoice/store', 'InvoiceController@storeInvoice')->name('invoice.store');

Route::get('/sales/product', 'SalesController@getProduct')->name('sales.product');

Route::get('/sales/price', 'SalesController@getPrice')->name('sales.price');


Route::get('/sales', 'SalesController@index')->name('sales');

Route::get('/ajax/getctrl', 'AjaxController@getctrl')->name('ajax.getctrl');
Route::post('ctrl', 'AjaxController@ctrl')->name('ajax.ctrl');

Route::resource('posts', 'PostController');

Route::resource('product', 'ProductController');

Route::post('/product/store', 'ProductController@store')->name('product.store');

Route::delete('/product/destroy/{id}', 'ProductController@destroy')->name('product.destroy');

Route::get('/product/edit/{id}', 'ProductController@edit')->name('product.edit');

Route::post('/product/update', 'ProductController@update')->name('product.update');

Route::get('/product', 'ProductController@index')->name('product');

Route::resource('job', 'JobController');
Route::post('job/store', 'JobController@store')->name('job.store');
 

Route::get('/ajax', function(){
    return view('ajax');
});

Route::get('/ajax/get', 'AjaxController@get')->name('ajax.get');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware("auth");

Route::get('/auth/signup', 'AuthController@getSignUp')->name('signup');

Route::post('/auth/signup', 'AuthController@postSignUp')->name('auth.postSignup');

Route::get('/auth/signin', 'AuthController@signIn')->name('signin');

Route::post('/auth/signin', 'AuthController@doSignIn')->name('auth.doSignin');

Route::get('/auth/logout', 'AuthController@logout')->name('auth.logout');

Route::get('login', 'AuthController@signIn');

Route::get('/product/delete/{id}', 'ProductController@delete');