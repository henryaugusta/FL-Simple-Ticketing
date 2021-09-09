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
Route::get('/user/ticket/{id}/edit', 'User\TicketController@viewDetail');
Route::get('/user/ticket/{id}/delete', 'User\TicketController@destroy');

Route::post('/user/regis', 'RegistrasiController@store');


Route::get('/admin/home', 'HomeController@homeAdmin');
Route::get('/admin/karyawan/tambah', 'HomeController@homeAdmin');

Route::get('/admin/ticket/{status}', 'Admin\TicketController@viewManage');

Route::get('/operator/home', 'HomeController@homeAdmin');

Route::get('/process/ticket/{status}', 'Admin\TicketController@viewManage');
Route::get('/admin/ticket/{id}/delete', 'Admin\TicketController@destroy');
Route::post('/admin/ticket/{id}/update_status', 'Admin\TicketController@update_status');


Route::get('/admin/ticket/{id}/edit', 'Admin\TicketController@viewDetail');

Route::post('ticket/discussion/{id}/post', 'DiscussionController@store');
Route::post('ticket/delegate', 'Admin\TicketController@delegate');


Route::get('/karyawan/tambah', 'KaryawanController@viewAddKaryawan');
Route::post('/karyawan/tambah', 'KaryawanController@store');
Route::get('/karyawan/manage', 'KaryawanController@viewManage');
Route::get('/karyawan/{id}/delete', 'KaryawanController@destroy');
Route::get('/karyawan/{id}/edit', 'KaryawanController@viewEdit');
Route::post('/karyawan/{id}/edit', 'KaryawanController@edit');

Route::get('/kirim-email', 'EmailController@index');


Route::prefix('kategori')->group(function () {
    Route::get('tambah', 'CategoryController@viewCreate');
    Route::post('tambah', 'CategoryController@store');
    Route::get('manage', 'CategoryController@viewManage');
    Route::get('{id}/delete', 'CategoryController@destroy');
    Route::get('{id}/edit', 'CategoryController@viewEdit');
    Route::post('{id}/edit', 'CategoryController@update');
});


