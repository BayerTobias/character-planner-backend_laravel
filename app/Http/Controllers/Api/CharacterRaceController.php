<?php

namespace App\Http\Controllers\Api;

use App\Actions\Character\GetCharacterRaceListAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\CharacterRaceResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class CharacterRaceController extends Controller
{
    /**
     * Get a list of all character races.
     *
     * Delegates retrieval of character races to GetCharacterRaceListAction
     * and returns the result as a resource collection.
     *
     * @param GetCharacterRaceListAction $action The action handling the use-case.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     *         A resource collection containing all character races.
     */
    public function getRaceList(GetCharacterRaceListAction $action): AnonymousResourceCollection
    {
        $races = $action->execute();

        return CharacterRaceResource::collection($races);
    }
}
