<?php

namespace App\Http\Controllers\Api;

use App\Actions\Items\GetWeaponGroupListAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\WeaponGroupResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WeaponGroupController extends Controller
{
    /**
     * Retrieve a list of all weapon groups.
     *
     * Delegates the retrieval to GetWeaponGroupListAction and returns
     * the weapon groups as a resource collection.
     *
     * @param GetWeaponGroupListAction $action The action handling the use-case.
     * @return AnonymousResourceCollection A collection of weapon group resources.
     */
    public function getWeaponGroupList(GetWeaponGroupListAction $action): AnonymousResourceCollection
    {
        $weaponGroups = $action->execute();

        return WeaponGroupResource::collection($weaponGroups);
    }
}
