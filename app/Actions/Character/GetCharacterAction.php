<?php

namespace App\Actions\Character;

use App\Models\characters\Character;
use App\Repositories\Contracts\Character\CharacterRepositoryInterface;

class GetCharacterAction
{
  public function __construct(
    private readonly CharacterRepositoryInterface $characterRepository
  ) {
  }

  public function execute(int $characterId, int $userId): ?Character
  {
    return $this->characterRepository->getByIdForUser($characterId, $userId);
  }
}