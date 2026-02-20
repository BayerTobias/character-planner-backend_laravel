<?php

namespace App\Http\Controllers\Api;

use App\Actions\Character\GetCharacterClassListAction;
use App\Actions\Character\GetCharacterClassWithSkillsAction;
use App\Http\Controllers\Controller;
use App\Models\characters\CharacterClass;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CharacterClassController extends Controller
{
    /**
     * Get a list of all character classes.
     *
     * @return JsonResponse
     *         A JSON response containing the list of all character classes.
     */
    public function getClassList(GetCharacterClassListAction $action): JsonResponse
    {
        $classes = $action->execute();

        return response()->json($classes);
    }


    /**
     * Get a specific character class along with its basic skills.
     *
     * Delegates the retrieval to GetCharacterClassWithSkillsAction. 
     * Returns the class with its basic skills as JSON, or a 404 JSON response
     * if the class does not exist.
     *
     * @param int $id The ID of the character class to retrieve.
     * @param GetCharacterClassWithSkillsAction $action The action handling the use-case.
     * @return JsonResponse JSON response containing the class or an error message.
     */
    public function getClassWithSkills($id, GetCharacterClassWithSkillsAction $action): JsonResponse
    {
        try {
            $class = $action->execute($id);

            return response()->json($class);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Class not found'], 404);
        }
    }
}
