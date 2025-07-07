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

            "character_race" => [
                'id' => $this->characterRace->id,
                'name' => $this->characterRace->name,
            ],

            "character_class" => [
                "id" => $this->characterClass->id,
                "name" => $this->characterClass->name,
                "base_lvl_hp" => $this->characterClass->base_lvl_hp,
                "base_lvl_mana" => $this->characterClass->base_lvl_mana,
                "main_stat" => $this->characterClass->main_stat,
                "color" => $this->characterClass->color,
            ],

            "base_armor" => $this->baseArmor ? [
                "id" => $this->baseArmor->id,
                "name" => $this->baseArmor->name,
                "min_str" => $this->baseArmor->min_str,
                "armor_bonus" => $this->baseArmor->armor_bonus,
                "maneuver_bonus" => $this->baseArmor->maneuver_bonus,
                "weight" => $this->baseArmor->weight,
            ] : null,

            "base_weapons" => $this->baseWeapons->map(
                fn(BaseWeapon $weapon): array =>
                [
                    "id" => $weapon->weight,
                    "name" => $weapon->name,
                    "min_str" => $weapon->min_str,
                    "dmg" => $weapon->dmg,
                    "attribute" => $weapon->attribute,
                    "weight" => $weapon->weight,
                    "ini_bonus" => $weapon->ini_bonus,
                ]
            ),

            "custom_weapons" => $this->customWeapons->map(
                fn(CustomWeapon $weapon): array =>
                [
                    "id" => $weapon->weight,
                    "name" => $weapon->name,
                    "min_str" => $weapon->min_str,
                    "dmg" => $weapon->dmg,
                    "attribute" => $weapon->attribute,
                    "weight" => $weapon->weight,
                    "ini_bonus" => $weapon->ini_bonus,
                    'special' => $weapon->special,
                ]
            ),

            "money" => [
                "id" => $this->money->id,
                "gf" => $this->money->gf,
                "tt" => $this->money->tt,
                "kl" => $this->money->kl,
                "mu" => $this->money->mu,
            ],

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
