<?php

namespace App\Repositories\Eloquent\Items;

use App\Models\Items\BaseWeapon;
use App\Repositories\Contracts\Items\BaseWeaponRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class BaseWeaponRepository implements BaseWeaponRepositoryInterface
{

  public function getAll(): Collection
  {
    return BaseWeapon::all();
  }
}