<?php

namespace App\Repositories\Contracts\Character;

interface CharacterRepositoryInterface
{
  public function getByIdForUser(int $characterId, int $userId);

  public function getListForUser(int $userId);
}