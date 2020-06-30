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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/detail/{slug}', 'DetailController@index')->name('detail');

Route::get('/dashboard', 'UserDashboardController@index')
    ->name('user-dashboard')
    ->middleware(['auth']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard/edit', 'ProfileController@edit')
        ->name('edit');

    Route::patch('dashboard/edit', 'ProfileController@update')
        ->name('update');
});

Route::post('/checkout/{id}', 'CheckoutController@process')
    ->name('checkout_process')
    ->middleware(['auth','verified']);

Route::get('/checkout/{id}', 'CheckoutController@index')
    ->name('checkout')
    ->middleware(['auth','verified']);

Route::post('/checkout/create/{detail_id}', 'CheckoutController@create')
    ->name('checkout_create')
    ->middleware(['auth','verified']);

Route::get('/checkout/remove/{detail_id}', 'CheckoutController@remove')
    ->name('checkout_remove')
    ->middleware(['auth','verified']);

Route::get('/checkout/confirm/{id}', 'CheckoutController@success')
    ->name('checkout_success')
    ->middleware(['auth','verified']);

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth','admin'])
    ->group(function(){
        Route::get('/', 'DashboardController@index')
            ->name('dashboard');

        Route::resource('travel-package', 'TravelPackageController');
        Route::resource('gallery', 'GalleryController');
        Route::resource('transaction', 'TransactionController');
    });

Auth::routes(['verify' => true]);
