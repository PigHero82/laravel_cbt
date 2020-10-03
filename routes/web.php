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

Route::view('', 'sitemap');

Route::namespace('admin')->name('admin.')->prefix('admin')->group(function() {
    Route::view('', 'index')->name('index');
    Route::namespace('portal')->name('portal.')->prefix('portal')->group(function() {
        Route::view('peserta', 'peserta')->name('peserta');
        Route::view('mata-kuliah', 'mata-kuliah')->name('mata-kuliah');
    });
});
