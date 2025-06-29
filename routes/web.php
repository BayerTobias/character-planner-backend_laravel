<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reset-password/{token}', function ($token) {

    return redirect("http://localhost:4200/reset-password?token=$token");
})->name('password.reset');
