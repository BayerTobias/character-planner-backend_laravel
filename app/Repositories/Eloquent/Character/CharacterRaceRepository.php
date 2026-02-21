<?php

namespace App\Repositories\Eloquent\Character;

use App\Models\characters\CharacterRace;
use App\Repositories\Contracts\Character\CharacterRaceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CharacterRaceRepository implements CharacterRaceRepositoryInterface
{
  public function getAll(): Collection
  {
    return CharacterRace::all();
  }
}