<?php

namespace App\Http\Controllers\Api;

use App\Actions\Character\GetCharacterClassListAction;
use App\Actions\Character\GetCharacterClassWithSkillsAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\CharacterClassResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;

class CharacterClassController extends Controller
{
    /**
     * Get a list of all character classes.
     *
     * @return JsonResponse
     *         A JSON response containing the list of all character classes.
     */
    public function getClassList(GetCharacterClassListAction $action)
    {
        $classes = $action->execute();

        return response()->json($classes);
    }


    /**
     * Get a specific character class along with its basic skills.
     *
     * Delegates retrieval to GetCharacterClassWithSkillsAction and returns
     * the result as a CharacterClassResource. Returns a 404 JSON response
     * if the class does not exist.
     *
     * @param int $id The ID of the character class to retrieve.
     * @param GetCharacterClassWithSkillsAction $action The action handling the use-case.
     * @return CharacterClassResource|\Illuminate\Http\JsonResponse
     *         The class resource or a 404 error JSON response.
     */
    public function getClassWithSkills($id, GetCharacterClassWithSkillsAction $action): CharacterClassResource|JsonResponse
    {
        try {
            $class = $action->execute($id);

            return new CharacterClassResource($class);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Class not found'], 404);
        }
    }
}
