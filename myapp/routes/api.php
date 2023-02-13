<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\LogoutController;

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

Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

// Admin
Route::group(['middleware' => ['jwt.verify:admin']],function(){
    
    // User Group
    Route::get('/profile',[UserController::class, 'profile_admin']);
    Route::post('/user', [UserController::class, 'register']);
    Route::get('/user',[UserController::class, 'get']);
    Route::put('/user/{id}', [UserController::class, 'edit']);
    Route::delete('/user/{id}', [UserController::class, 'delete']);

    // Meja Group
    Route::get('/meja',[MejaController::class, 'get']);
    Route::post('/meja', [MejaController::class, 'create']);
    Route::put('/meja/{id}', [MejaController::class, 'update']);
    Route::delete('/meja/{id}', [MejaController::class, 'delete']);

    // Menu Group
    Route::get('/menu',[MenuController::class, 'get']);
    Route::post('/menu', [MenuController::class, 'create']);
});

// Kasir
Route::group(['middleware' => ['jwt.verify:kasir']],function(){
    Route::get('/profile',[UserController::class, 'profile_kasir']);
});

// Manager
Route::group(['middleware' => ['jwt.verify:manager']],function(){
    Route::get('/profile',[UserController::class, 'profile_manager']);
});