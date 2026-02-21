<?php

namespace App\Repositories\Contracts\Character;

use Illuminate\Database\Eloquent\Collection;

interface CharacterRaceRepositoryInterface
{
  public function getAll(): Collection;
}