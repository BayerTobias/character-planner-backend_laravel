<?php

namespace App\Repositories\Contracts\Items;

use Illuminate\Database\Eloquent\Collection;

interface BaseWeaponRepositoryInterface
{
  public function getAll(): Collection;
}