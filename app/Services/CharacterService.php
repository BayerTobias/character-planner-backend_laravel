<?php

namespace App\Services;

use App\Data\Character\CharacterCreateOrUpdateData;
use App\Data\Character\CustomWeaponData;
use App\Models\characters\Character;
use App\Models\items\CustomWeapon;
use App\Repositories\Contracts\Character\CharacterRepositoryInterface;

class CharacterService
{
  public function __construct(private CharacterRepositoryInterface $characterRepository)
  {
  }


  /**
   * Creates a new character or updates an existing one.
   *
   * Orchestrates the complete character persistence workflow:
   * - resolves existing character or instantiates a new one
   * - fills base character attributes
   * - persists the character entity
   * - delegates money, skills, weapons and custom weapon handling
   *
   * This service contains application-level business logic and
   * coordinates repository operations without exposing persistence details.
   *
   * @param CharacterCreateOrUpdateData $data The aggregated character data DTO.
   * @return Character The persisted character entity.
   */
  public function createOrUpdateCharacter(CharacterCreateOrUpdateData $data): Character
  {
    $character = $this->findOrCreateCharacter($data->id, $data->userId);

    $character->fill($data->toFillableArray());

    $character = $this->characterRepository->save($character);

    $this->updateOrCreateMoney($character, $data->money);
    $this->syncBasicSkills($character, $data->skilledSkills);
    $this->syncBasicWeapons($character, $data->baseWeapons);
    $this->updateOrCreateCustomWeapons($character, $data->customWeapons);

    return $character;
  }


  /**
   * Retrieves an existing character for the given user
   * or creates a new instance if none is found.
   *
   * Ensures that a character can only be updated
   * if it belongs to the authenticated user.
   *
   * @param int|null $characterId The optional character ID.
   * @param int $userId The authenticated user ID.
   * @return Character The resolved or newly instantiated character.
   */
  private function findOrCreateCharacter(?int $characterId, int $userId): Character
  {
    if ($characterId) {
      $character = $this->characterRepository->getByIdForUser($characterId, $userId);

      if ($character) {
        return $character;
      }
    }

    return new Character();
  }

  /**
   * Updates or creates the money record for the character.
   *
   * Delegates persistence logic to the repository.
   *
   * @param Character $character The owning character.
   * @param array $moneyData The structured money data.
   * @return void
   */
  private function updateOrCreateMoney(Character $character, array $moneyData)
  {
    $this->characterRepository->updateOrCreateMoney($character, $moneyData);
  }

  /**
   * Synchronizes the character's skilled basic skills.
   *
   * Transforms the incoming skill array into the required
   * pivot sync format and delegates the persistence to the repository.
   *
   * @param Character $character The owning character.
   * @param array $skills The skilled skill payload.
   * @return void
   */
  private function syncBasicSkills(Character $character, array $skills)
  {
    $syncData = collect($skills)
      ->mapWithKeys(fn($skill) => [
        $skill['skill_id'] => ['nodes_skilled' => $skill['nodes_skilled']]
      ])->all();

    $this->characterRepository->syncBasicSkills($character, $syncData);
  }

  /**
   * Synchronizes the character's base weapons.
   *
   * Delegates pivot synchronization to the repository.
   *
   * @param Character $character The owning character.
   * @param array $baseWeapons Array of base weapon IDs.
   * @return void
   */
  private function syncBasicWeapons(Character $character, array $baseWeapons)
  {
    $this->characterRepository->syncBasicWeapons($character, $baseWeapons);
  }

  /**
   * Updates, creates and synchronizes the character's custom weapons.
   *
   * Handles the complete custom weapon lifecycle:
   * - removes deleted weapons
   * - updates existing weapons
   * - creates new weapons
   * - synchronizes associated weapon groups
   *
   * @param Character $character The owning character.
   * @param CustomWeaponData[] $customWeapons Array of custom weapon DTOs.
   * @return void
   */
  private function updateOrCreateCustomWeapons(Character $character, array $customWeapons)
  {
    $existingIds = collect($customWeapons)->pluck('id')->filter()->toArray();

    $this->characterRepository->deleteMissingCustomWeapons($character, $existingIds);

    foreach ($customWeapons as $weaponData) {
      $customWeapon = $this->characterRepository->updateOrCreateCustomWeapon($character, $weaponData);
      $this->characterRepository->syncWeaponGroups($customWeapon, $weaponData->weaponGroupIds);
    }
  }
}