<?php

namespace App\Repositories\Contracts\Items;

use Illuminate\Database\Eloquent\Collection;

interface WeaponGroupRepositoryInterface
{
  public function getAll(): Collection;
}