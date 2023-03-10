<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\BukuapiController;
use PhpOffice\PhpSpreadsheet\Worksheet\Row;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/bukuapi', [BukuapiController::class, 'index']);
Route::post('/bukuapi/store', [BukuapiController::class, 'store']);
Route::post('/bukuapi/update', [BukuapiController::class, 'update']);
Route::delete('/bukuapi/destroy/{id}', [BukuapiController::class, 'destroy']);