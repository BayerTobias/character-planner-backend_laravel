<?php

namespace App\Repositories\Eloquent\Character;

use App\Data\Character\CustomWeaponData;
use App\Models\characters\Character;
use App\Models\items\CustomWeapon;
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

  public function save(Character $character): Character
  {
    $character->save();
    return $character;
  }

  public function updateOrCreateMoney(Character $character, array $moneyData): void
  {
    $character->money()->updateOrCreate([], $moneyData);
  }

  public function syncBasicSkills(Character $character, array $syncData): void
  {
    $character->basicSkills()->sync($syncData);
  }

  public function syncBasicWeapons(Character $character, array $baseWeapons): void
  {
    $character->baseWeapons()->sync($baseWeapons);
  }

  public function deleteMissingCustomWeapons(Character $character, array $customWeaponsIds): void
  {
    $character->customWeapons()
      ->whereNotIn('id', $customWeaponsIds)
      ->delete();
  }

  public function updateOrCreateCustomWeapon(Character $character, CustomWeaponData $customWeapon): CustomWeapon
  {
    return $character->customWeapons()->updateOrCreate(
      ['id' => $customWeapon->id],
      $customWeapon->toAttributes($character->id)
    );
  }

  public function syncWeaponGroups(CustomWeapon $weapon, array $groupIds): void
  {
    $weapon->weaponGroups()->sync($groupIds);
  }
}