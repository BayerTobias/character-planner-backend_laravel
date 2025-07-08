<?php

use App\Http\Controllers\Api\CharacterController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
  Route::get('/characters/{id}', [CharacterController::class, 'show']);
  Route::get('/characters', [CharacterController::class, 'getCharactersList']);
});