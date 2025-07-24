<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WeaponGroupResource;
use App\Models\Items\WeaponGroup;
use Illuminate\Http\Request;

class WeaponGroupController extends Controller
{
    public function getWeaponGroupList()
    {
        $weaponGroups = WeaponGroup::all();

        return WeaponGroupResource::collection($weaponGroups);
    }
}
