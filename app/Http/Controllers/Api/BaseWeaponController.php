<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseWeaponResource;
use App\Repositories\Contracts\Items\BaseWeaponRepositoryInterface;

class BaseWeaponController extends Controller
{
    public function __construct(
        private BaseWeaponRepositoryInterface $baseWeaponRepository
    ) {
    }

    /**
     * Get a list of all base weapons.
     *
     * Retrieves all base weapons via repository and returns them
     * as API resource collection.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getBaseWeaponsList()
    {
        $baseWeapons = $this->baseWeaponRepository->getAll();

        return BaseWeaponResource::collection($baseWeapons);
    }
}
