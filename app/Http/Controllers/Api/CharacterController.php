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
        $user = Auth::user();

        $character = Character::with([
            'characterRace',
            'characterClass.basicSkills',
            'baseArmor',
            'baseWeapons',
            'customWeapons',
            'money',
            'basicSkills'
        ])
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

        $character = $this->characterService->createOrUpdateCharacter($validatet);

        // $validatet['user_id'] = Auth::id();


        // $character = Character::create($validatet);


        // $character->money()->create([
        //     'gf' => $validatet['money']['gf'],
        //     'tt' => $validatet['money']['tt'],
        //     'kl' => $validatet['money']['kl'],
        //     'mu' => $validatet['money']['mu'],
        // ]);



        // $syncData = collect($validatet['skilled_skills'])
        //     ->mapWithKeys(fn($skill) => [
        //         $skill['id'] => ['nodes_skilled' => $skill['nodes_skilled']]
        //     ])->all();

        // $character->basicSkills()->sync($syncData);

        return response()->json([
            'message' => 'Character object',
            'character' => $character,
        ]);
    }
}
