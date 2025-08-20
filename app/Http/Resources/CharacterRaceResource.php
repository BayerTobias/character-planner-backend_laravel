<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CharacterRaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'strength_modifier' => $this->strength_modifier,
            'agility_modifier' => $this->agility_modifier,
            'constitution_modifier' => $this->constitution_modifier,
            'intelligence_modifier' => $this->intelligence_modifier,
            'charisma_modifier' => $this->charisma_modifier
        ];
    }
}
