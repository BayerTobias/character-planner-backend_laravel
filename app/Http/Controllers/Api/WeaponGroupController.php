<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WeaponGroupResource;
use App\Models\Items\WeaponGroup;
use Illuminate\Http\Request;

class WeaponGroupController extends Controller
{
    /**
     * Get a list of all weapon groups.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     *         A JSON response containing the list of weapon groups.
     */
    public function getWeaponGroupList()
    {
        $weaponGroups = WeaponGroup::all();

        return WeaponGroupResource::collection($weaponGroups);
    }
}
