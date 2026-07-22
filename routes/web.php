<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reset-password/{token}', function (Request $request, string $token){
    return  response()->json([
        'message' => 'Use this token and email with the POST /api/reset-password endpoint.',
        'token' => $token,
        'email' => $request->query('email'),
    ]);
})->name('password.reset');