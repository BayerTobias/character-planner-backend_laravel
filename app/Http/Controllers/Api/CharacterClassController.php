<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\characters\CharacterClass;
use Illuminate\Http\Request;

class CharacterClassController extends Controller
{
    public function getClassList()
    {
        $classes = CharacterClass::all();

        return response()->json($classes);
    }

    public function getClassWithSkills($id)
    {
        $class = CharacterClass::with('basicSkills')->find($id);

        if (!$class) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        return response()->json($class);
    }
}
