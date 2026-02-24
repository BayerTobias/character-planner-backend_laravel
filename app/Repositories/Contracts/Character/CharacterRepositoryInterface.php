<?php

namespace App\Repositories\Contracts\Character;

interface CharacterRepositoryInterface
{
  public function findByIdForUser(int $id, int $userId);
}