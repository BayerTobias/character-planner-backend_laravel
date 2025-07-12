<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CharacterCreateUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:25',

            'character_race_id' => 'required|integer|exists:character_races,id',
            'character_class_id' => 'required|integer|exists:character_classes,id',

            'max_hp' => 'required|integer|min:1',
            'current_hp' => 'required|integer|min:0|lte:max_hp',

            'max_mana' => 'nullable|integer|min:0',
            'current_mana' => 'nullable|integer|min:0|lte:max_mana',

            'strength_value' => 'required|integer|min:1',
            'strength_bonus' => 'required|integer|',
            'agility_value' => 'required|integer|min:1',
            'agility_bonus' => 'required|integer|',
            'constitution_value' => 'required|integer|min:1',
            'constitution_bonus' => 'required|integer|',
            'intelligence_value' => 'required|integer|min:1',
            'intelligence_bonus' => 'required|integer|',
            'charisma_value' => 'required|integer|min:1',
            'charisma_bonus' => 'required|integer|',

            'base_armor_id' => 'nullable|integer|exists:base_armors,id',
            'user_id' => 'required|integer|exists:users,id',
            'current_lvl' => 'required|integer|min:1',
            'attribute_points' => 'required|integer|min:0'
        ];
    }
}
