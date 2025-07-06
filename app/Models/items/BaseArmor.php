<?php

namespace App\Models\Items;

use App\Models\characters\Character;
use Illuminate\Database\Eloquent\Model;

class BaseArmor extends Model
{
    protected $fillable = ['name', 'min_str', 'armor_bonus', 'maneuver_bonus', 'weight'];

    public function characters()
    {
        return $this->hasMany(Character::class);
    }
}
