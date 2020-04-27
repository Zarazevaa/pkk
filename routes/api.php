<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'petugas_controller@register');
Route::post('login', 'petugas_controller@login');

Route::post('/simpan_pelanggan','pelanggan_controller@store')->middleware('jwt.verify');
Route::put('/ubah_pelanggan/{id}','pelanggan_controller@update')->middleware('jwt.verify');
Route::delete('/hapus_pelanggan/{id}','pelanggan_controller@destroy')->middleware('jwt.verify');
Route::get('/tampil_pelanggan','pelanggan_controller@tampil_pelanggan')->middleware('jwt.verify');

Route::post('/simpan_pelatih','pelatih_controller@store')->middleware('jwt.verify');
Route::put('/ubah_pelatih/{id}','pelatih_controller@update')->middleware('jwt.verify');
Route::delete('/hapus_pelatih/{id}','pelatih_controller@destroy')->middleware('jwt.verify');
Route::get('/tampil_pelatih','pelatih_controller@tampil_pelatih')->middleware('jwt.verify');

Route::post('/simpan_jadwal','jadwal_controller@store')->middleware('jwt.verify');
Route::put('/ubah_jadwal/{id}','jadwal_controller@update')->middleware('jwt.verify');
Route::delete('/hapus_jadwal/{id}','jadwal_controller@destroy')->middleware('jwt.verify');
Route::get('/tampil_jadwal','jadwal_controller@tampil_jadwal')->middleware('jwt.verify');

Route::post('/simpan_transaksi','transaksi_controller@store')->middleware('jwt.verify');
Route::put('/ubah_transaksi/{id}','transaksi_controller@update')->middleware('jwt.verify');
Route::delete('/hapus_transaksi/{id}','transaksi_controller@destroy')->middleware('jwt.verify');
Route::get('/tampil_transaksi/{tgl_transaksi}/{tgl_mulai}','transaksi_controller@tampil_transaksi')->middleware('jwt.verify');

Route::post('/simpan_detail','detail_transaksi_controller@store')->middleware('jwt.verify');
Route::put('/ubah_detail/{id}','detail_transaksi_controller@update')->middleware('jwt.verify');
Route::delete('/hapus_detail/{id}','detail_transaksi_controller@destroy')->middleware('jwt.verify');
Route::get('/tampil_detail','detail_transaksi_controller@tampil_detail')->middleware('jwt.verify');
