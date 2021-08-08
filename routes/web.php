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

Route::redirect('/','/login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');





Route::view('registrasi','auth.registrasi');
Route::post('/login/proc', 'Auth\LoginController@checkLogin');

Route::get('/user/home', 'HomeController@homeUser');
Route::get('/user/ticket/create', 'User\TicketController@viewCreate');
Route::post('/user/ticket/create', 'User\TicketController@store');
Route::get('/user/ticket/pending', 'User\TicketController@viewUserPending');
Route::get('/user/ticket/progress', 'User\TicketController@viewUserProgress');
Route::get('/user/ticket/complete', 'User\TicketController@viewUserComplete');

Route::get('/admin/home', 'HomeController@homeAdmin');
