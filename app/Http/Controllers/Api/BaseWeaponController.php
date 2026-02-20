<?php

namespace App\Http\Controllers\Api;

use App\Actions\Items\GetBaseWeaponsListAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\BaseWeaponResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BaseWeaponController extends Controller
{

    /**
     * Get a list of all base weapons.
     *
     * Delegates retrieval of base weapons to the GetBaseWeaponsListAction
     * and returns the result as a resource collection.
     * 
     * @return AnonymousResourceCollection
     * 
     */
    public function getBaseWeaponsList(GetBaseWeaponsListAction $action): AnonymousResourceCollection
    {
        $baseWeapons = $action->execute();

        return BaseWeaponResource::collection($baseWeapons);
    }
}
