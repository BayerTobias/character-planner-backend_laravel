<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseWeaponResource;
use App\Models\Items\BaseWeapon;
use Illuminate\Http\Request;

class BaseWeaponController extends Controller
{
    /**
     * Get a list of all base weapons.
     *
     * This method retrieves all base armor records from the database,
     * transforms them into API resources, and returns the collection
     * as a JSON response.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     *         A JSON response containing the list of base weapons.
     */
    public function getBaseWeaponsList()
    {
        $baseWeapons = BaseWeapon::all();

        return BaseWeaponResource::collection($baseWeapons);
    }
}
