<?php

namespace App\Repositories\Eloquent\Items;

use App\Models\Items\WeaponGroup;
use App\Repositories\Contracts\Items\WeaponGroupRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class WeaponGroupRepository implements WeaponGroupRepositoryInterface
{
  public function getAll(): Collection
  {
    return WeaponGroup::all();
  }
}