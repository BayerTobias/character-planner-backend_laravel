<?php

namespace App\Models\Items;

use App\Models\characters\Character;
use Illuminate\Database\Eloquent\Model;

class BaseWeapon extends Model
{
    protected $fillable = [
        'name',
        'min_str',
        'dmg',
        'attribute',
        'weight',
        'ini_bonus'
    ];

    public function weaponGroups()
    {
        return $this->belongsToMany(WeaponGroup::class);
    }

    public function characters()
    {
        return $this->belongsToMany(Character::class);
    }
}
