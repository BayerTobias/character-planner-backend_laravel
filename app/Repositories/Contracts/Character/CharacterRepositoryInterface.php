<?php

namespace App\Repositories\Contracts\Character;

use App\Data\Character\CustomWeaponData;
use App\Models\characters\Character;
use App\Models\items\CustomWeapon;
use Illuminate\Database\Eloquent\Collection;

interface CharacterRepositoryInterface
{
  public function getByIdForUser(int $characterId, int $userId): ?Character;

  public function getListForUser(int $userId): Collection;

  public function save(Character $character): Character;

  public function updateOrCreateMoney(Character $character, array $moneyData): void;
  public function syncBasicSkills(Character $character, array $skills): void;
  public function syncBasicWeapons(Character $character, array $weapons): void;
  public function deleteMissingCustomWeapons(Character $character, array $customWeaponsIds): void;
  public function updateOrCreateCustomWeapon(Character $character, CustomWeaponData $customWeapon): CustomWeapon;
  public function syncWeaponGroups(CustomWeapon $weapon, array $groupIds): void;
}