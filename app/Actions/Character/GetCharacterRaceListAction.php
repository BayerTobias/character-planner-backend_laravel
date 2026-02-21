<?php

namespace App\Actions\Character;

use App\Repositories\Contracts\Character\CharacterRaceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class GetCharacterRaceListAction
{
  public function __construct(
    private CharacterRaceRepositoryInterface $characterRaceRepository
  ) {
  }

  public function execute(): Collection
  {
    return $this->characterRaceRepository->getAll();
  }
}