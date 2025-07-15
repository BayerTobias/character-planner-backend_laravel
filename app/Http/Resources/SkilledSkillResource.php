<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SkilledSkillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->pivot->id,
            'skill' => $this->id,
            'nodes_skilled' => $this->pivot->nodes_skilled ?? 0,
        ];
    }
}
