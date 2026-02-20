<?php

namespace App\Repositories\Eloquent\Character;

use App\Models\characters\CharacterClass;
use App\Repositories\Contracts\Character\CharacterClassRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CharacterClassRepository implements CharacterClassRepositoryInterface
{
  public function getAll(): Collection
  {
    return CharacterClass::all();
  }

  public function getWithBasicSkills(int $id): ?CharacterClass
  {
    return CharacterClass::with('basicSkills')->find($id);
  }
}