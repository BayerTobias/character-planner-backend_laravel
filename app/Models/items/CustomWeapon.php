<?php

namespace App\Models\items;

use App\Models\characters\Character;
use Illuminate\Database\Eloquent\Model;

class CustomWeapon extends Model
{
    protected $fillable = [
        'name',
        'min_str',
        'dmg',
        'attribute',
        'weight',
        'ini_bonus',
        'special',
        'character_id'
    ];

    public function weaponGroups()
    {
        return $this->belongsToMany(WeaponGroup::class);
    }

    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
