<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseArmorResource extends JsonResource
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
            "min_str" => $this->min_str,
            "armor_bonus" => $this->armor_bonus,
            "maneuver_bonus" => $this->maneuver_bonus,
            "weight" => $this->weight,
            "type" => $this->type,
        ];
    }
}
