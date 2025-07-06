<?php

namespace App\Models\characters;

use Illuminate\Database\Eloquent\Model;

class CharacterClass extends Model
{
    protected $fillable = ['name', 'base_lvl_hp', 'base_lvl_mana', 'main_stat', 'color'];

    public function characters()
    {
        return $this->hasMany(Character::class);
    }
}
