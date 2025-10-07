<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\characters\CharacterClass;
use Illuminate\Http\Request;

class CharacterClassController extends Controller
{
    /**
     * Get a list of all character classes.
     *
     * @return \Illuminate\Http\JsonResponse
     *         A JSON response containing the list of all character classes.
     */
    public function getClassList()
    {
        $classes = CharacterClass::all();

        return response()->json($classes);
    }

    /**
     * Get a specific character class along with its basic skills.
     *
     * This method retrieves a single character class by its ID,
     * including all related basic skills. If the class does not exist,
     * a 404 response is returned.
     *
     * @param  int  $id  The ID of the character class to retrieve.
     * @return \Illuminate\Http\JsonResponse
     *         A JSON response containing the class and its skills, or a 404 message.
     */
    public function getClassWithSkills($id)
    {
        $class = CharacterClass::with('basicSkills')->find($id);

        if (!$class) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        return response()->json($class);
    }
}
