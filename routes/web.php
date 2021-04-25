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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/db-migrate', function () {
    $status = Artisan::call('migrate', array('--force' => true));
    return '<h1>DB Migration done!</h1>';
});
Route::get('/token', function () {
    return csrf_token();
});
Route::get('/user/{id}', 'UserController@show');
Route::post('/user', 'UserController@update');
