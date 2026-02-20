<?php

namespace App\Http\Controllers\Api;

use App\Actions\Items\GetBaseArmorListAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\BaseArmorResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;



class BaseArmorController extends Controller
{

    /**
     * Get a list of all base armors.
     *
     * Delegates retrieval of base armors to the GetBaseArmorListAction
     * and returns the result as a resource collection.
     * 
     * @return AnonymousResourceCollection
     * 
     */
    public function getBaseArmorList(GetBaseArmorListAction $action): AnonymousResourceCollection
    {
        $armors = $action->execute();

        return BaseArmorResource::collection($armors);
    }
}
