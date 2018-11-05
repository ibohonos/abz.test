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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/create', 'WorkersController@createWorker')->name('create.worker');
Route::post('/create', 'WorkersController@saveWorker')->name('save.worker');
Route::post('/delete', 'WorkersController@deleteWorker')->name('delete.worker');
Route::get('/edit/{id}', 'WorkersController@editWorker')->name('edit.worker');
Route::post('/update', 'WorkersController@updateWorker')->name('update.worker');
Route::get('/worker/{id}', 'WorkersController@showWorker')->name('show.worker');
Route::get('/workers', 'WorkersController@listWorkers')->name('list.worker');
