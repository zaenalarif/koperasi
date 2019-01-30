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

Route::get('/', 'MemberController@index');
Route::get('/member/create', 'MemberController@create');
Route::post('/member/create', 'MemberController@store');
Route::get('/member/{id}/edit', 'MemberController@edit');
Route::put('/member/{id}/edit', 'MemberController@update');
Route::delete('/member/{id}', 'MemberController@destroy');

Route::get('/tabungan/create', 'TabunganController@create');
Route::post('/tabungan/create', 'TabunganController@store');

Route::get('/transaction/menyetor', 'TransactionController@menyetor');
Route::post('/transaction/menyetor', 'TransactionController@menyetorStore');

Route::get('/transaction/withdraw', 'TransactionController@withdraw');
Route::post('/transaction/withdraw', 'TransactionController@withdrawStore');

Route::get('/mutasi/list', 'MutasiController@listMutasi');
Route::get('/mutasi/bunga', 'MutasiController@listBunga');
Route::post('/mutasi/bunga', 'MutasiController@storeBunga');