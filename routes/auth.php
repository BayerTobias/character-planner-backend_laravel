<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\{AuthContoller, ForgotPasswordController, ResetPasswordController};
use Illuminate\Http\Request;

// AuthRoutes
Route::post('/register', [AuthContoller::class, 'register']);
Route::post('/login', [AuthContoller::class, 'login']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendPasswordResetEmail']);
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword']);

Route::middleware('auth:sanctum')->group(function () {
  Route::post('/logout', [AuthContoller::class, 'logout']);
  Route::get('/check-auth', [AuthContoller::class, 'checkAuth']);
  Route::get('/user', fn(Request $request) => $request->user());
});






