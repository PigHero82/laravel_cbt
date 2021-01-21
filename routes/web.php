<?php

use App\ListRole;
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

View::composer(['*'], function ($view) {
    if (Auth::user() !== NULL) {
        $role = ListRole::getRole(Auth::user()->id);
        View::share('composerRole', $role);
    }
});

Route::get('', 'HomeController@index')->middleware('auth')->name('home');
Route::post('role/{id}', 'HomeController@update')->name('role.update');
Route::resource('akun', 'AkunController');

Route::namespace('Dosen')->name('dosen.')->prefix('pengampu')->middleware('auth', 'role:pengampu')->group(function() {
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
            Route::get('data/{id}/{user}', 'SoalController@data_jawaban');
            Route::post('data', 'SoalController@data_jawaban_store')->name('store');
            Route::get('jawaban/{id}', 'SoalController@laporanjawaban_show')->name('jawaban.show');
        });
    });
});

Route::name('admin.')->prefix('admin')->middleware('auth', 'role:admin')->group(function() {
    Route::namespace('Admin')->group(function () {
        Route::get('', 'HomeController@index')->name('index');
        Route::get('pengaturan', 'HomeController@pengaturan')->name('pengaturan');
        Route::post('pengaturan', 'HomeController@store_pengaturan')->name('store.pengaturan');
        Route::namespace('Portal')->name('portal.')->prefix('portal')->group(function() {
            Route::resource('user', 'UserController');
            Route::resource('pengampu', 'PengampuController');
            Route::name('user.')->prefix('user')->group(function () {
                Route::post('import', 'UserController@import')->name('import');
                Route::get('role/{id}', 'UserController@showRole');
                Route::post('role/{id}', 'UserController@role')->name('role');
            });
            Route::resource('kelas', 'KelasController');
            Route::get('data/kelas', 'KelasController@data_peserta');
            Route::resource('mata-kuliah', 'MataKuliahController');
            Route::resource('kelas/detail', 'KelasMahasiswaController');
            Route::resource('prodi', 'ProdiController');
            Route::view('pengumuman', 'pengumuman')->name('pengumuman');
        });
        Route::view('laporan', 'admin.laporan.index')->name('laporan.index');
    });

    Route::namespace('Dosen\Soal')->group(function () {
        Route::name('laporan.')->prefix('laporan')->group(function () {
            Route::get('', 'SoalController@laporan_index')->name('index');
            Route::get('{id}', 'SoalController@laporan_show')->name('show');
            Route::get('data/{id}/{user}', 'SoalController@data_jawaban');
            Route::post('data', 'SoalController@data_jawaban_store')->name('store');
            Route::get('jawaban/{id}', 'SoalController@laporanjawaban_show')->name('jawaban.show');
        });
    });
});

Route::namespace('Mahasiswa')->prefix('peserta')->middleware('auth', 'role:peserta')->group(function() {
    Route::get('', 'HomeController@index')->name('index');
    Route::get('soal/{id}', 'HomeController@soal')->name('soal');
    Route::get('data-soal/{id}', 'HomeController@data_soal')->name('data');
    Route::post('jawab', 'HomeController@jawab')->name('jawab');
});

Auth::routes();
