<?php

namespace App\Http\Resources;

use App\Models\characters\Character;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CharacterListResource extends JsonResource
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
            'character_race' => $this->characterRace->name,
            'character_class' => $this->characterClass->name,
            'class_color' => $this->characterClass->color,
        ];
    }
}
