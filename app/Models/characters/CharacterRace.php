<?php

namespace App\Models\characters;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacterRace extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'strength_modifier',
        'agility_modifier',
        'constitution_modifier',
        'intelligence_modifier',
        'charisma_modifier'
    ];

    public function characters()
    {
        return $this->hasMany(Character::class);
    }
}
