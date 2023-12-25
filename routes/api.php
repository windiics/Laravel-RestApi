<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\mahasiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/', function(){
    return response()->json([
        'status'    => false,
        'message'   => 'akses tidak diperbolehkan',
    ], 401);
})->name('login');

Route::get('mahasiswa', [mahasiswaController::class, 'index'])->middleware('auth:sanctum', 'ablity:list-mahasiswa');
Route::get('mahasiswa/{id}', [mahasiswaController::class, 'show'])->middleware('auth:sanctum', 'ablity:mahasiswa-show');
Route::post('mahasiswa', [mahasiswaController::class, 'store'])->middleware('auth:sanctum', 'ablity:mahasiswa-store');
Route::put('mahasiswa/{id}', [mahasiswaController::class, 'update'])->middleware('auth:sanctum', 'ablity:mahasiswa-update');
Route::delete('mahasiswa/{id}', [mahasiswaController::class, 'destroy'])->middleware('auth:sanctum', 'ablity:mahasiswa-delete');


Route::post('registerUser', [authController::class, 'registerUser']);
Route::post('loginUser', [authController::class, 'loginUser']);