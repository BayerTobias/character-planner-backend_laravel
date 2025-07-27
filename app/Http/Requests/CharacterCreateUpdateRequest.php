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
            'id' => 'nullable|integer|exists:characters,id',
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

            'current_lvl' => 'required|integer|min:1',
            'attribute_points' => 'required|integer|min:0',

            'money' => 'required|array',
            'money.gf' => 'required|integer|min:0',
            'money.kl' => 'required|integer|min:0',
            'money.mu' => 'required|integer|min:0',
            'money.tt' => 'required|integer|min:0',

            'skilled_skills' => 'nullable|array',
            'skilled_skills.*.skill_id' => 'sometimes|required|integer|exists:basic_skills,id',
            'skilled_skills.*.nodes_skilled' => 'sometimes|required|integer|min:1',

            'base_weapons' => 'nullable|array',
            'base_weapons.*' => 'sometimes|required|integer|exists:base_weapons,id',

            'custom_weapons' => 'nullable|array',
            'custom_weapons.*.id' => 'nullable|integer|exists:custom_weapons,id',
            'custom_weapons.*.name' => 'sometimes|required|string|max:50',
            'custom_weapons.*.weapon_group' => 'sometimes|required|array',
            'custom_weapons.*.weapon_group.*' => 'sometimes|required|integer|exists:weapon_groups,id',
            'custom_weapons.*.min_str' => 'nullable|integer',
            'custom_weapons.*.dmg' => 'sometimes|required|integer',
            'custom_weapons.*.attribute' => 'nullable|string|max:5',
            'custom_weapons.*.weight' => 'nullable|numeric|min:0',
            'custom_weapons.*.ini_bonus' => 'nullable|integer',
            'custom_weapons.*.special' => 'nullable|string|max:250',
        ];
    }
}
