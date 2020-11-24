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
Route::get('', 'HomeController@index')->name('home');

Route::namespace('Dosen')->name('dosen.')->prefix('dosen')->middleware('auth', 'role:dosen')->group(function() {
    Route::get('', 'HomeController@index')->name('index');
    Route::get('mahasiswa', 'HomeController@mahasiswa')->name('mahasiswa');
    Route::view('cetak', 'dosen.cetak')->name('cetak');
    Route::namespace('Soal')->group(function () {
        Route::resource('soal', 'SoalController')->except(['index']);
        Route::get('soal/edit/{id}', 'SoalController@data_soal')->name('edit-soal');
        Route::resource('paket', 'PaketController');
        Route::resource('pilihan', 'PilihanController');
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

Route::namespace('Mahasiswa')->prefix('mahasiswa')->middleware('auth', 'role:mahasiswa')->group(function() {
    Route::get('', 'HomeController@index')->name('index');
    // Route::view('', 'front.index')->name('index');
    Route::view('soal', 'front.soal')->name('soal');
});

Auth::routes();
