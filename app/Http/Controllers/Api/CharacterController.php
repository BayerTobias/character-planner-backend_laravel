<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CharacterCreateUpdateRequest;
use App\Http\Resources\CharacterListResource;
use App\Http\Resources\CharacterResource;
use App\Models\characters\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{
    public function show($id)
    {
        $user = Auth::user();

        $character = Character::with(['characterRace', 'characterClass', 'baseArmor', 'baseWeapons', 'customWeapons', 'money'])
            ->where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$character) {
            return response()->json(['message' => 'Character nor found or nor authorized'], 404);
        }

        return new CharacterResource($character);
    }

    public function getCharactersList()
    {
        $user = Auth::user();

        $characters = Character::with(['characterRace', 'characterClass'])
            ->where('user_id', $user->id)
            ->get();

        return CharacterListResource::collection($characters);
    }

    public function createOrUpdateCharacter(CharacterCreateUpdateRequest $request)
    {
        $validatet = $request->validated();

        // $character = new Character($validatet);
        $character = Character::create($validatet);

        return response()->json([
            'message' => 'Character object',
            'character' => $character,
        ]);
    }
}
