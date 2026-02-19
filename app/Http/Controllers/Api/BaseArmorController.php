<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseArmorResource;
use App\Models\Items\BaseArmor;
use App\Repositories\Contracts\Items\BaseArmorRepositoryInterface;
use Illuminate\Http\Request;

class BaseArmorController extends Controller
{
    public function __construct(
        private BaseArmorRepositoryInterface $baseArmorRepository
    ) {
    }

    /**
     * Get a list of all base armors.
     *
     * Retrieves all base armors via repository and returns them
     * as API resource collection.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getBaseArmorList()
    {
        $armors = $this->baseArmorRepository->getAll();

        return BaseArmorResource::collection($armors);
    }
}
