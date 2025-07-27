<?php

use App\Http\Controllers\Api\BaseArmorController;
use App\Http\Controllers\Api\BaseWeaponController;
use App\Http\Controllers\Api\WeaponGroupController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
  // Weapon Groups
  Route::get('/weapon-groups', [WeaponGroupController::class, 'getWeaponGroupList']);

  // Base Weapons
  Route::get('/base-weapons', [BaseWeaponController::class, 'getBaseWeaponsList']);

  // Base Armors
  Route::get('/base-armors', [BaseArmorController::class, 'getBaseArmorList']);

});