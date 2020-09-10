<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', 'ExportController@index');
Route::get('export/products/{type?}', 'ExportController@exportProducts')->name('export.products');
Route::get('export/customers/{type?}', 'ExportController@exportCustomers')->name('export.customers');
Route::get('export/categories/{type?}', 'ExportController@exportCategories')->name('export.categories');
Route::get('export/atributes/{type?}', 'ExportController@exportAtributes')->name('export.atributes');
Route::get('export/advanced-price/{type?}', 'ExportController@exportAdvancedPrice')->name('export.advanced-price');
