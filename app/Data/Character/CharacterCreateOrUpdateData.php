<?php

namespace App\Data\Character;

use App\Http\Requests\CharacterCreateUpdateRequest;

class CharacterCreateOrUpdateData
{
  public function __construct(
    public readonly ?int $id,
    public readonly int $userId,

    public readonly string $name,
    public readonly int $characterRaceId,
    public readonly int $characterClassId,

    public readonly int $maxHp,
    public readonly int $currentHp,
    public readonly ?int $maxMana,
    public readonly ?int $currentMana,

    public readonly int $strengthValue,
    public readonly int $strengthBonus,
    public readonly int $agilityValue,
    public readonly int $agilityBonus,
    public readonly int $constitutionValue,
    public readonly int $constitutionBonus,
    public readonly int $intelligenceValue,
    public readonly int $intelligenceBonus,
    public readonly int $charismaValue,
    public readonly int $charismaBonus,

    public readonly ?int $baseArmorId,
    public readonly ?int $shieldId,

    public readonly int $currentLvl,
    public readonly int $attributePoints,

    /** @var array{gf:int,kl:int,mu:int,tt:int} */
    public readonly array $money,

    /** @var array<int,array{skill_id:int,nodes_skilled:int}> */
    public readonly array $skilledSkills,

    /** @var int[] */
    public readonly array $baseWeapons,

    /** @var CustomWeaponData[] */
    public readonly array $customWeapons,
  ) {
  }

  public static function fromRequest(CharacterCreateUpdateRequest $request, int $userId): self
  {
    $validated = $request->validated();

    return new self(
      id: $validated['id'] ?? null,
      userId: $userId,

      name: $validated['name'],
      characterRaceId: $validated['character_race_id'],
      characterClassId: $validated['character_class_id'],

      maxHp: $validated['max_hp'],
      currentHp: $validated['current_hp'],
      maxMana: $validated['max_mana'] ?? null,
      currentMana: $validated['current_mana'] ?? null,

      strengthValue: $validated['strength_value'],
      strengthBonus: $validated['strength_bonus'],
      agilityValue: $validated['agility_value'],
      agilityBonus: $validated['agility_bonus'],
      constitutionValue: $validated['constitution_value'],
      constitutionBonus: $validated['constitution_bonus'],
      intelligenceValue: $validated['intelligence_value'],
      intelligenceBonus: $validated['intelligence_bonus'],
      charismaValue: $validated['charisma_value'],
      charismaBonus: $validated['charisma_bonus'],

      baseArmorId: $validated['base_armor_id'] ?? null,
      shieldId: $validated['shield_id'] ?? null,

      currentLvl: $validated['current_lvl'],
      attributePoints: $validated['attribute_points'],

      money: $validated['money'],
      skilledSkills: $validated['skilled_skills'] ?? [],
      baseWeapons: $validated['base_weapons'] ?? [],
      customWeapons: collect($validated['custom_weapons'] ?? [])
        ->map(fn($weapon) => CustomWeaponData::fromArray($weapon))
        ->toArray(),
    );
  }

  public function toFillableArray(): array
  {
    return [
      'id' => $this->id,
      'user_id' => $this->userId,
      'name' => $this->name,
      'character_race_id' => $this->characterRaceId,
      'character_class_id' => $this->characterClassId,
      'max_hp' => $this->maxHp,
      'current_hp' => $this->currentHp,
      'max_mana' => $this->maxMana,
      'current_mana' => $this->currentMana,
      'strength_value' => $this->strengthValue,
      'strength_bonus' => $this->strengthBonus,
      'agility_value' => $this->agilityValue,
      'agility_bonus' => $this->agilityBonus,
      'constitution_value' => $this->constitutionValue,
      'constitution_bonus' => $this->constitutionBonus,
      'intelligence_value' => $this->intelligenceValue,
      'intelligence_bonus' => $this->intelligenceBonus,
      'charisma_value' => $this->charismaValue,
      'charisma_bonus' => $this->charismaBonus,
      'base_armor_id' => $this->baseArmorId,
      'shield_id' => $this->shieldId,
      'current_lvl' => $this->currentLvl,
      'attribute_points' => $this->attributePoints,
    ];
  }
}