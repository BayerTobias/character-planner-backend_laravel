<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CharacterClassResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "base_lvl_hp" => $this->base_lvl_hp,
            "base_lvl_mana" => $this->base_lvl_mana,
            "main_stat" => $this->main_stat,
            "color" => $this->color,
            "basic_skills" => BasicSkillResource::collection($this->whenLoaded('basicSkills'))
        ];
    }
}
