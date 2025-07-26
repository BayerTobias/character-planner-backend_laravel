<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseWeaponResource;
use App\Models\Items\BaseWeapon;
use Illuminate\Http\Request;

class BaseWeaponController extends Controller
{
    public function getBaseWeaponsList()
    {
        $baseWeapons = BaseWeapon::all();

        return BaseWeaponResource::collection($baseWeapons);
    }
}
