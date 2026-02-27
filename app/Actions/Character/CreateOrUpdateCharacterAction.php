<?php

namespace App\Actions\Character;

use App\Data\Character\CharacterCreateOrUpdateData;
use App\Models\characters\Character;
use App\Services\CharacterService;

class CreateOrUpdateCharacterAction
{
  public function __construct(private CharacterService $characterService)
  {
  }

  public function execute(CharacterCreateOrUpdateData $data): Character
  {
    return $this->characterService->createOrUpdateCharacter($data);
  }
}