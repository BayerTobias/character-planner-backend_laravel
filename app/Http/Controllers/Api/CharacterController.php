<?php

namespace App\Http\Controllers\Api;

use App\Actions\Character\GetCharacterAction;
use App\Actions\Character\GetCharacterListAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CharacterCreateUpdateRequest;
use App\Http\Resources\CharacterListResource;
use App\Http\Resources\CharacterResource;
use App\Services\CharacterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
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
     * @return CharacterResource|JsonResponse
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
     * Delegates retrieval to GetCharacterListAction and returns
     * a resource collection containing basic character overview data
     * (e.g. name, class, race).
     *
     * @param GetCharacterListAction $action The action handling the use-case.
     * @return AnonymousResourceCollection
     */
    public function getCharactersList(GetCharacterListAction $action): AnonymousResourceCollection
    {
        $characters = $action->execute(Auth::id());

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
