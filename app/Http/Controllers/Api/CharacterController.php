<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CharacterCreateUpdateRequest;
use App\Http\Resources\CharacterListResource;
use App\Http\Resources\CharacterResource;
use App\Models\characters\Character;
use App\Services\CharacterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{

    public function __construct(private CharacterService $characterService)
    {

    }
    public function show($id)
    {
        $character = Character::with([
            'characterRace',
            'characterClass.basicSkills',
            'baseArmor',
            'shield',
            'baseWeapons',
            'customWeapons',
            'money',
            'basicSkills'
        ])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$character) {
            return response()->json(['message' => 'Character nor found or nor authorized'], 404);
        }

        return new CharacterResource($character);
    }

    public function getCharactersList()
    {
        $characters = Character::with(['characterRace', 'characterClass'])
            ->where('user_id', Auth::id())
            ->get();

        return CharacterListResource::collection($characters);
    }

    public function createOrUpdateCharacter(CharacterCreateUpdateRequest $request)
    {
        $validatet = $request->validated();

        $character = $this->characterService->createOrUpdateCharacter($validatet);

        $character->load(
            [
                'characterRace',
                'characterClass.basicSkills',
                'baseArmor',
                'shield',
                'baseWeapons',
                'customWeapons',
                'money',
                'basicSkills'
            ]
        );

        return new CharacterResource($character);
    }
}
