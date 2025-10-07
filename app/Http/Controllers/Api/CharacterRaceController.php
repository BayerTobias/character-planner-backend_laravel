<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\characters\CharacterRace;
use Illuminate\Http\Request;

class CharacterRaceController extends Controller
{
    /**
     * Get a list of all character races.
     *
     * @return \Illuminate\Http\JsonResponse
     *         A JSON response containing the list of character races.
     */
    public function getRaceList()
    {
        $races = CharacterRace::all();

        return response()->json($races);
    }
}
