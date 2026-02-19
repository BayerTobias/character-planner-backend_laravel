<?php

namespace App\Repositories\Contracts\Items;

use Illuminate\Database\Eloquent\Collection;

interface BaseArmorRepositoryInterface
{
  public function getAll(): Collection;
}