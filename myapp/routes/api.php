<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

// Admin
Route::group(['middleware' => ['jwt.verify:admin']],function(){
    Route::get('/profile_admin',[UserController::class, 'profile_admin']);
});

// Kasir
Route::group(['middleware' => ['jwt.verify:kasir']],function(){
    Route::get('/profile_kasir',[UserController::class, 'profile_kasir']);
});

// Manager
Route::group(['middleware' => ['jwt.verify:manager']],function(){
    Route::get('/profile_manager',[UserController::class, 'profile_manager']);
});