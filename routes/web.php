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

Route::get('/', function () {
    return view('datatables');
});

Route::get('/datatables', 'ContentsController@datatables');
Route::post('/datatables', 'ContentsController@loadDatatables');

Route::get('/vis', function () {
    return view('vis');
});

Route::get('/chartjs', 'ContentsController@chartJS');