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

// Route::view('/login', 'login')->name('login');

Route::namespace('Dosen')->name('dosen.')->prefix('dosen')->middleware('auth', 'role:dosen')->group(function() {
    Route::get('', 'HomeController@index')->name('index');
    Route::get('mahasiswa', 'HomeController@mahasiswa')->name('mahasiswa');
    Route::view('cetak', 'dosen.cetak')->name('cetak');
    Route::namespace('Soal')->name('soal.')->prefix('soal')->group(function() {
        Route::resource('', 'PaketController');
        // Route::view('', 'dosen.soal.index')->name('index');
        Route::view('1', 'dosen.soal.show')->name('show');
        Route::view('1/1', 'dosen.soal.single')->name('single');
    });
});

Route::name('admin.')->prefix('admin')->middleware('auth', 'role:admin')->group(function() {
    Route::get('', 'Admin\HomeController@index')->name('index');
    Route::name('portal.')->prefix('portal')->group(function() {
        Route::resource('mahasiswa', 'Admin\Portal\MahasiswaController');
        Route::resource('dosen', 'Admin\Portal\DosenController');
        Route::resource('kelas', 'Admin\Portal\KelasController');
        Route::resource('mata-kuliah', 'Admin\Portal\MataKuliahController');
        Route::resource('kelas/detail', 'Admin\Portal\KelasMahasiswaController');
        Route::view('pengumuman', 'pengumuman')->name('pengumuman');
    });
});

Route::namespace('Mahasiswa')->prefix('')->group(function() {
    Route::get('', 'HomeController@index')->name('index');
    // Route::view('', 'front.index')->name('index');
    Route::view('soal', 'front.soal')->name('soal');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
