<?php

namespace App\Services;

use App\Http\Requests\CharacterCreateUpdateRequest;
use App\Models\characters\Character;
use App\Models\items\CustomWeapon;
use Illuminate\Support\Facades\Auth;

class CharacterService
{


  public function createOrUpdateCharacter(array $validated)
  {
    $validated['user_id'] = Auth::id();

    $character = $this->findOrCreateCharacter($validated);

    $character->fill($validated)->save();

    $this->updateOrCreateMoney($character, $validated['money']);
    $this->syncBasicSkills($character, $validated['skilled_skills'] ?? []);
    $this->syncBasicWeapons($character, $validated['base_weapons'] ?? []);
    $this->updateOrCreateCustomWeapons($character, $validated['custom_weapons'] ?? []);

    return $character;
  }

  private function findOrCreateCharacter(array $validated)
  {
    if (!empty($validated['id'])) {
      $character = Character::where('id', $validated['id'])
        ->where('user_id', $validated['user_id'])
        ->first();

      if ($character) {
        return $character;
      }
    }

    return new Character();
  }

  private function updateOrCreateMoney(Character $character, array $moneyData)
  {
    $character->money()->updateOrCreate([], $moneyData);
  }

  private function syncBasicSkills(Character $character, array $skills)
  {
    $syncData = collect($skills)
      ->mapWithKeys(fn($skill) => [
        $skill['skill_id'] => ['nodes_skilled' => $skill['nodes_skilled']]
      ])->all();

    $character->basicSkills()->sync($syncData);
  }

  private function syncBasicWeapons(Character $character, array $baseWeapons)
  {
    $character->baseWeapons()->sync($baseWeapons);
  }

  private function updateOrCreateCustomWeapons(Character $character, array $customWeapons)
  {
    $existingIds = collect($customWeapons)->pluck('id')->filter()->toArray();

    $character->customWeapons()
      ->whereNotIn('id', $existingIds)
      ->delete();

    foreach ($customWeapons as $weaponData) {

      $weaponGroupIds = $weaponData['weapon_group'] ?? [];
      unset($weaponData['weapon_group']);

      $weaponData['character_id'] = $character->id;

      $customWeapon = CustomWeapon::updateOrCreate(
        ['id' => $weaponData['id'] ?? null],
        $weaponData
      );

      $customWeapon->weaponGroups()->sync($weaponGroupIds);
    }
  }
}