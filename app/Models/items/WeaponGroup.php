<?php

namespace App\Models\Items;

use Illuminate\Database\Eloquent\Model;

class WeaponGroup extends Model
{
    protected $table = 'weapon_groups';
    protected $fillable = ['name'];

    public function baseWeapons()
    {
        return $this->belongsToMany(BaseWeapon::class);
    }

    public function customWeapons()
    {
        return $this->belongsToMany(CustomWeapon::class);
    }
}
