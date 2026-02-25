<?php

namespace App\Repositories\Eloquent\Character;

use App\Models\characters\Character;
use App\Repositories\Contracts\Character\CharacterRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CharacterRepository implements CharacterRepositoryInterface
{
  public function getByIdForUser(int $characterId, int $userId): ?Character
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

  public function getListForUser(int $userId): Collection
  {
    return Character::with(['characterRace', 'characterClass'])
      ->where('user_id', $userId)
      ->get();
  }
}