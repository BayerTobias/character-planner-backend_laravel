<?php

namespace App\Models\characters;

use App\Models\skills\BasicSkill;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacterClass extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'base_lvl_hp', 'base_lvl_mana', 'main_stat', 'color'];

    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    public function basicSkills()
    {
        return $this->hasMany(BasicSkill::class);
    }
}
