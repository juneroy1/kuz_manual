<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::get('/profile', [ProfileController::class, 'show']);
Route::put('profile', [ProfileController::class, 'update']);


Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);