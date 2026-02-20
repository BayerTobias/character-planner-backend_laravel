<?php

namespace App\Repositories\Contracts\Character;

use App\Models\characters\CharacterClass;
use Illuminate\Database\Eloquent\Collection;

interface CharacterClassRepositoryInterface
{
  public function getAll(): Collection;

  public function getWithBasicSkills(int $id): ?CharacterClass;
}