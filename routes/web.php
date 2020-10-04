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

Route::namespace('dosen')->name('dosen.')->prefix('dosen')->group(function() {
    Route::view('', 'dosen.index')->name('index');
});

Route::namespace('admin')->name('admin.')->prefix('admin')->group(function() {
    Route::view('', 'index')->name('index');
    Route::namespace('portal')->name('portal.')->prefix('portal')->group(function() {
        Route::view('alur', 'alur')->name('alur');
        Route::namespace('peserta')->name('peserta.')->prefix('peserta')->group(function() {
            Route::view('', 'peserta.index')->name('index');
            Route::view('/123456', 'peserta.show')->name('show');
        });
        Route::view('mata-kuliah', 'mata-kuliah')->name('mata-kuliah');
        Route::view('pengumuman', 'pengumuman')->name('pengumuman');
    });
});

Route::namespace('')->name('')->prefix('')->group(function() {
    Route::view('', 'front.index')->name('index');
    Route::view('soal', 'front.soal')->name('soal');
});
