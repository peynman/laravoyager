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


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::get('horizon', function () {
	    return view('horizon.index');
    })->name('laravel.horizon');
});

Route::get('provinces', function () {
	return implode(', ', \App\Models\Province::where('country_id', 1)->pluck('title')->toArray());
});