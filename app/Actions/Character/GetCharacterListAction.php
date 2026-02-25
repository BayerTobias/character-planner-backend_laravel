<?php

namespace App\Actions\Character;

use App\Repositories\Contracts\Character\CharacterRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class GetCharacterListAction
{
  public function __construct(private CharacterRepositoryInterface $characterRepository)
  {
  }
  public function execute(int $userId): Collection
  {
    return $this->characterRepository->getListForUser($userId);
  }
}