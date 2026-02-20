<?php

namespace App\Actions\Character;

use App\Repositories\Contracts\Character\CharacterClassRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class GetCharacterClassListAction
{
  public function __construct(
    private CharacterClassRepositoryInterface $characterClassRepository
  ) {
  }

  /**
   * Retrieve all character classes.
   *
   * Returns a collection of CharacterClass models from the repository.
   *
   * @return Collection<int, \App\Models\characters\CharacterClass>
   */
  public function execute(): Collection
  {
    return $this->characterClassRepository->getAll();
  }
}