<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\{AuthContoller, ForgotPasswordController, ResetPasswordController};
use Illuminate\Http\Request;

// AuthRoutes
Route::post('/register', [AuthContoller::class, 'register']);
Route::post('/login', [AuthContoller::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthContoller::class, 'logout']);

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendPasswordResetEmail']);

Route::middleware('auth:sanctum')->get('/user', fn(Request $request) => $request->user());
