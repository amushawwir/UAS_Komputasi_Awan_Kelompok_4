<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    return view('landingpage');
});

Route::get('/syarat', function () {
    return view('syaratpage');
});

Auth::routes();

Route::group(['prefix' => '/admin'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin.dashboard')->middleware('admin');
    Route::get('/index', [AdminController::class, 'index'])->name('admin.index')->middleware('admin');
    Route::get('/create', [AdminController::class, 'create'])->name('admin.create')->middleware('admin');
    Route::post('/create/user', [AdminController::class, 'store'])->name('admin.store')->middleware('admin');
    //Route::get('/search', [AdminController::class, 'search'])->name('admin.search')->middleware('admin');
    Route::get('/show/{id}', [AdminController::class, 'show'])->name('admin.show')->middleware('admin');
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit')->middleware('admin');
    Route::put('/update/{id}', [AdminController::class, 'update'])->name('admin.update')->middleware('admin');
    Route::delete('/delete/{id}', [AdminController::class, 'destroy'])->name('admin.destroy')->middleware('admin');
    //Route::get('/data/user', [UserController::class, 'index'])->name('index')->middleware('admin'); //kenapa malah nampilkan create form pendaftaran?
});

Route::group(['prefix' => '/user'], function(){
    Route::get('/', [HomeController::class, 'index'])->name('user');
    Route::get('/daftar', [PendaftarController::class, 'create'])->name('daftar');
    Route::post('/daftarkan', [PendaftarController::class, 'store'])->name('daftarkan');
    Route::get('/edit', [PendaftarController::class, 'edit'])->name('edit');
    Route::post('/simpanedit', [PendaftarController::class, 'update'])->name('simpanedit');
    Route::get('/detail', [PendaftarController::class, 'show'])->name('show');
    Route::get('/cetak_formulir', [PendaftarController::class, 'cetak_formulir'])->name('cetak_formulir');
});


Route::get('logout', [LoginController::class, 'logout']);


