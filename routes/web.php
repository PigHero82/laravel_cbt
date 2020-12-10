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

Route::get('', 'HomeController@index')->middleware('auth')->name('home');

Route::namespace('Dosen')->name('dosen.')->prefix('dosen')->middleware('auth', 'role:dosen')->group(function() {
    Route::get('', 'HomeController@index')->name('index');
    Route::get('mahasiswa', 'HomeController@mahasiswa')->name('mahasiswa');
    Route::view('cetak', 'dosen.cetak')->name('cetak');
    Route::namespace('Soal')->group(function () {
        Route::resource('soal', 'SoalController')->except(['index']);
        Route::prefix('edit')->group(function () {
            Route::get('{id}', 'SoalController@data_soal')->name('edit-soal');
            Route::patch('{id}/update', 'SoalController@data_soal_update')->name('edit-soal.update');
            Route::delete('{id}/delete', 'SoalController@data_soal_delete')->name('edit-soal.destroy');
        });
        Route::post('import', 'SoalController@import')->name('import');
        Route::resource('paket', 'PaketController');
        Route::resource('pilihan', 'PilihanController');
        Route::name('laporan.')->prefix('laporan')->group(function () {
            Route::get('', 'SoalController@laporan_index')->name('index');
            Route::get('{id}', 'SoalController@laporan_show')->name('show');
        });
    });
});

Route::namespace('Admin')->name('admin.')->prefix('admin')->middleware('auth', 'role:admin')->group(function() {
    Route::get('', 'HomeController@index')->name('index');
    Route::get('pengaturan', 'HomeController@pengaturan')->name('pengaturan');
    Route::post('pengaturan', 'HomeController@store_pengaturan')->name('store.pengaturan');
    Route::namespace('Portal')->name('portal.')->prefix('portal')->group(function() {
        Route::resource('mahasiswa', 'MahasiswaController');
        Route::resource('dosen', 'DosenController');
        Route::resource('kelas', 'KelasController');
        Route::resource('mata-kuliah', 'MataKuliahController');
        Route::resource('kelas/detail', 'KelasMahasiswaController');
        Route::view('pengumuman', 'pengumuman')->name('pengumuman');
    });
});

Route::namespace('Mahasiswa')->prefix('mahasiswa')->middleware('auth', 'role:mahasiswa')->group(function() {
    Route::get('', 'HomeController@index')->name('index');
    Route::get('soal/{id}', 'HomeController@soal')->name('soal');
    Route::get('data-soal/{id}', 'HomeController@data_soal');
    Route::post('jawab', 'HomeController@jawab')->name('jawab');
});

Auth::routes();
