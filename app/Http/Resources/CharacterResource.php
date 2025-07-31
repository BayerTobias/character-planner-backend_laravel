<?php

namespace App\Http\Resources;

use App\Models\characters\Character;
use App\Models\Items\BaseWeapon;
use App\Models\items\CustomWeapon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CharacterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Character $this */
        return [
            'id' => $this->id,
            'name' => $this->name,

            "max_hp" => $this->max_hp,
            "current_hp" => $this->current_hp,
            "max_mana" => $this->max_mana,
            "current_mana" => $this->current_mana,

            "character_race" => new CharacterRaceResource($this->whenLoaded('characterRace')),

            "character_class" => new CharacterClassResource($this->whenLoaded('characterClass')),

            "base_armor" => new BaseArmorResource($this->whenLoaded('baseArmor')),
            "shield" => new BaseArmorResource($this->whenLoaded('shield')),

            "base_weapons" => BaseWeaponResource::collection($this->whenLoaded("baseWeapons")),

            "custom_weapons" => CustomWeaponResource::collection($this->whenLoaded('customWeapons')),

            "money" => new MoneyResource($this->whenLoaded('money')),

            "skilled_skills" => SkilledSkillResource::collection($this->whenLoaded('basicSkills')),

            "strength_value" => $this->strength_value,
            "strength_bonus" => $this->strength_bonus,
            "agility_value" => $this->agility_value,
            "agility_bonus" => $this->agility_bonus,
            "constitution_value" => $this->constitution_value,
            "constitution_bonus" => $this->constitution_bonus,
            "intelligence_value" => $this->intelligence_value,
            "intelligence_bonus" => $this->intelligence_bonus,
            "charisma_value" => $this->charisma_value,
            "charisma_bonus" => $this->charisma_bonus,
            "user_id" => $this->user_id,
            "current_lvl" => $this->current_lvl,
            "attribute_points" => $this->attribute_points,

        ];
    }
}
