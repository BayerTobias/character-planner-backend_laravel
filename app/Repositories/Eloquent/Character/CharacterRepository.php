<?php

namespace App\Repositories\Eloquent\Character;

use App\Models\characters\Character;
use App\Repositories\Contracts\Character\CharacterRepositoryInterface;

class CharacterRepository implements CharacterRepositoryInterface
{
  public function findByIdForUser(int $characterId, int $userId): ?Character
  {

    return Character::with([
      'characterRace',
      'characterClass.basicSkills',
      'baseArmor',
      'shield',
      'baseWeapons',
      'customWeapons',
      'money',
      'basicSkills'
    ])
      ->where('id', $characterId)
      ->where('user_id', $userId)
      ->first();
  }
}