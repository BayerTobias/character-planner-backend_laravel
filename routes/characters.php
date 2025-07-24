<?php

use App\Http\Controllers\Api\CharacterClassController;
use App\Http\Controllers\Api\CharacterController;
use App\Http\Controllers\Api\CharacterRaceController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
  // Character
  Route::get('/characters/{id}', [CharacterController::class, 'show']);
  Route::get('/characters', [CharacterController::class, 'getCharactersList']);
  Route::post('/characters', [CharacterController::class, 'createOrUpdateCharacter']);

  // Classes
  Route::get('/classes', [CharacterClassController::class, 'getClassList']);
  Route::get('/classes/{id}', [CharacterClassController::class, 'getClassWithSkills']);

  // Races
  Route::get('/races', [CharacterRaceController::class, 'getRaceList']);
});