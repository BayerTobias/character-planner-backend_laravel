<?php

namespace App\Actions\Character;

use App\Repositories\Contracts\Character\CharacterClassRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GetCharacterClassWithSkillsAction
{

  public function __construct(
    private CharacterClassRepositoryInterface $characterClassRepository
  ) {
  }

  public function execute(int $id)
  {
    $class = $this->characterClassRepository->getWithBasicSkills($id);

    if (!$class) {
      throw new ModelNotFoundException("Character class with ID $id not found.");
    }

    return $class;
  }
}