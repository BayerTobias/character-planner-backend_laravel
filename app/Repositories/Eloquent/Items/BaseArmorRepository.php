<?php

namespace App\Repositories\Eloquent\Items;

use App\Models\Items\BaseArmor;
use App\Repositories\Contracts\Items\BaseArmorRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class BaseArmorRepository implements BaseArmorRepositoryInterface
{

  public function getAll(): Collection
  {
    return BaseArmor::all();
  }

}