<?php

namespace App\Models\characters;

use App\Models\Items\BaseArmor;
use App\Models\Items\BaseWeapon;
use App\Models\items\CustomWeapon;
use App\Models\skills\BasicSkill;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * ...
 */
class Character extends Model
{
    protected $fillable = [
        'name',
        'character_race_id',
        'character_class_id',
        'max_hp',
        'current_hp',
        'max_mana',
        'current_mana',
        'strength_value',
        'strength_bonus',
        'agility_value',
        'agility_bonus',
        'constitution_value',
        'constitution_bonus',
        'intelligence_value',
        'intelligence_bonus',
        'charisma_value',
        'charisma_bonus',
        'base_armor_id',
        'shield_id',
        'user_id',
        'current_lvl',
        'attribute_points'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function characterRace()
    {
        return $this->belongsTo(CharacterRace::class);
    }

    public function characterClass()
    {
        return $this->belongsTo(CharacterClass::class);
    }

    public function baseArmor()
    {
        return $this->belongsTo(BaseArmor::class);
    }

    public function shield()
    {
        return $this->belongsTo(BaseArmor::class, 'shield_id');
    }

    public function baseWeapons()
    {
        return $this->belongsToMany(BaseWeapon::class);
    }

    public function customWeapons()
    {
        return $this->hasMany(CustomWeapon::class);
    }

    public function money()
    {
        return $this->hasOne(Money::class);
    }

    public function basicSkills()
    {
        return $this->belongsToMany(BasicSkill::class, 'character_basic_skill')
            ->withPivot('nodes_skilled', 'id')
            ->withTimestamps();
    }

}
