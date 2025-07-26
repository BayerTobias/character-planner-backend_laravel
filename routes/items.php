<?php

use App\Http\Controllers\Api\BaseWeaponController;
use App\Http\Controllers\Api\WeaponGroupController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
  // Weapon Groups
  Route::get('/weapon-groups', [WeaponGroupController::class, 'getWeaponGroupList']);

  // Base Weapons
  Route::get('/base-weapons', [BaseWeaponController::class, 'getBaseWeaponsList']);
});