<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseArmorResource;
use App\Models\Items\BaseArmor;
use Illuminate\Http\Request;

class BaseArmorController extends Controller
{
    /**
     * Get a list of all base armors.
     *
     * This method retrieves all base armor records from the database,
     * transforms them into API resources, and returns the collection
     * as a JSON response.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     *         A JSON response containing the list of base armors.
     */
    public function getBaseArmorList()
    {
        $armors = BaseArmor::all();

        return BaseArmorResource::collection($armors);
    }
}
