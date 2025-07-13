<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\characters\CharacterRace;
use Illuminate\Http\Request;

class CharacterRaceController extends Controller
{
    public function getRaceList()
    {
        $races = CharacterRace::all();

        return response()->json($races);
    }
}
