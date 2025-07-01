<?php

namespace App\Models\Items;

use Illuminate\Database\Eloquent\Model;

class WeaponGroup extends Model
{
    protected $fillable = ['name'];

    public function baseWeapons()
    {
        return $this->belongsToMany(BaseWeapon::class);
    }
}
