<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\UserController;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard/index', [DashboardController::class, 'index']);
    // kategori
    Route::get('/kategori/index', [KategoriController::class, 'index']);
    Route::get('/kategori/create', [KategoriController::class, 'create']);
    Route::post('/kategori/store', [KategoriController::class, 'store']);
    Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit']);
    Route::post('/kategori/update/{id}', [KategoriController::class, 'update']);
    Route::get('/kategori/destroy/{id}', [KategoriController::class, 'destroy']);

    // Penulis
    Route::get('/penulis/index', [PenulisController::class, 'index']);
    Route::get('/penulis/create', [PenulisController::class, 'create']);
    Route::post('/penulis/store', [PenulisController::class, 'store']);
    Route::get('/penulis/edit/{id}', [PenulisController::class, 'edit']);
    Route::post('/penulis/update/{id}', [PenulisController::class, 'update']);
    Route::get('/penulis/destroy/{id}', [PenulisController::class, 'destroy']);

    // Penerbit
    Route::get('/penerbit/index', [PenerbitController::class, 'index']);
    Route::get('/penerbit/create', [PenerbitController::class, 'create']);
    Route::post('/penerbit/store', [PenerbitController::class, 'store']);
    Route::get('/penerbit/edit/{id}', [PenerbitController::class, 'edit']);
    Route::post('/penerbit/update/{id}', [PenerbitController::class, 'update']);
    Route::get('/penerbit/destroy/{id}', [PenerbitController::class, 'destroy']);

    // Buku
    Route::get('/buku/index', [BukuController::class, 'index']);
    Route::get('/buku/create', [BukuController::class, 'create']);
    Route::post('/buku/store', [BukuController::class, 'store']);
    Route::get('/buku/edit/{id}', [BukuController::class, 'edit']);
    Route::post('/buku/update/{id}', [BukuController::class, 'update']);
    Route::get('/buku/destroy/{id}', [BukuController::class, 'destroy']);
    Route::get('/buku/export-pdf/{id}', [BukuController::class, 'exportPdf']);
    Route::get('/buku/export-excel', [BukuController::class, 'exportExcel']);
});
