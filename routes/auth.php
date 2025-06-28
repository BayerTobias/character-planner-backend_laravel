<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', fn(Request $request) => $request->user());
Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);