<?php

namespace App\Models\characters;

use Illuminate\Database\Eloquent\Model;

class CharacterRace extends Model
{
    protected $fillable = ['name'];

    public function characters()
    {
        return $this->hasMany(Character::class);
    }
}
