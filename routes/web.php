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

Route::view('/login', 'login')->name('login');

Route::namespace('dosen')->name('dosen.')->prefix('dosen')->group(function() {
    Route::view('', 'dosen.index')->name('index');
    Route::view('mahasiswa', 'dosen.mahasiswa')->name('mahasiswa');
    Route::view('cetak', 'dosen.cetak')->name('cetak');
    Route::namespace('soal')->name('soal.')->prefix('soal')->group(function() {
        Route::view('', 'dosen.soal.index')->name('index');
        Route::view('1', 'dosen.soal.show')->name('show');
        Route::view('1/1', 'dosen.soal.single')->name('single');
    });
});

Route::namespace('admin')->name('admin.')->prefix('admin')->group(function() {
    Route::view('', 'index')->name('index');
    Route::namespace('portal')->name('portal.')->prefix('portal')->group(function() {
        Route::view('alur', 'alur')->name('alur');
        Route::resource('mahasiswa', 'MahasiswaController');
        Route::resource('dosen', 'DosenController');
        // Route::namespace('dosen')->name('dosen.')->prefix('dosen')->group(function() {
        //     Route::view('', 'admin.dosen.index')->name('index');
        //     Route::view('/123456', 'admin.dosen.show')->name('show');
        // });
        Route::namespace('kelas')->name('kelas.')->prefix('kelas')->group(function() {
            Route::view('', 'admin.kelas.index')->name('index');
        });
        Route::view('mata-kuliah', 'mata-kuliah')->name('mata-kuliah');
        Route::view('pengumuman', 'pengumuman')->name('pengumuman');
    });
});

Route::namespace('')->name('')->prefix('')->group(function() {
    Route::view('', 'front.index')->name('index');
    Route::view('soal', 'front.soal')->name('soal');
});
