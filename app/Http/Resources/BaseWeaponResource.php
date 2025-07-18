<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseWeaponResource extends JsonResource
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
            "dmg" => $this->dmg,
            "attribute" => $this->attribute,
            "weight" => $this->weight,
            "ini_bonus" => $this->ini_bonus,
            'weapon_group' => WeaponGroupResource::collection($this->weaponGroups)
        ];
    }
}
