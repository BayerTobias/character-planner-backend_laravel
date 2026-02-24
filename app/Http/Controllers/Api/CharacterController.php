<?php

namespace App\Http\Controllers\Api;

use App\Actions\Character\GetCharacterAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CharacterCreateUpdateRequest;
use App\Http\Resources\CharacterListResource;
use App\Http\Resources\CharacterResource;
use App\Models\characters\Character;
use App\Services\CharacterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{

    public function __construct(private CharacterService $characterService)
    {

    }

    /**
     * Returns the full details of a specific character.
     *
     * Delegates retrieval to GetCharacterAction and returns the character
     * with all related data as a resource. Returns 404 if the character
     * does not exist or does not belong to the authenticated user.
     *
     * @param int $id
     * @param GetCharacterAction $action
     * @return JsonResponse
     */
    public function show(int $id, GetCharacterAction $action): CharacterResource|JsonResponse
    {
        $character = $action->execute($id, Auth::id());

        if (!$character) {
            return response()->json(['message' => 'Character not found or not authorized'], 404);
        }

        return new CharacterResource($character);
    }

    /**
     * Returns a list of all characters belonging to the authenticated user.
     *
     * Loads only basic information (e.g. name, class, race)
     * since the overview list doesn’t need deeply nested relationships.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getCharactersList()
    {
        $characters = Character::with(['characterRace', 'characterClass'])
            ->where('user_id', Auth::id())
            ->get();

        return CharacterListResource::collection($characters);
    }

    /**
     * Creates or updates a character based on the provided request data.
     *
     * This method:
     *  - Validates the incoming request via CharacterCreateUpdateRequest
     *  - Calls the CharacterService to handle create/update logic
     *  - Reloads all relationships after saving to return a complete response
     *  - Returns the character as a resource
     *
     * @param \App\Http\Requests\CharacterCreateUpdateRequest $request
     * @return \App\Http\Resources\CharacterResource
     */
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
