<?php

namespace App\Data\Character;

class CustomWeaponData
{
  public function __construct(
    public ?int $id,
    public string $name,
    public ?int $minStr,
    public int $dmg,
    public ?string $attribute,
    public ?float $weight,
    public ?int $iniBonus,
    public ?string $special,
    public array $weaponGroupIds,
  ) {
  }

  public static function fromArray(array $data): self
  {
    return new self(
      id: $data['id'] ?? null,
      name: $data['name'],
      minStr: $data['min_str'] ?? null,
      dmg: $data['dmg'],
      attribute: $data['attribute'] ?? null,
      weight: $data['weight'] ?? null,
      iniBonus: $data['ini_bonus'] ?? null,
      special: $data['special'] ?? null,
      weaponGroupIds: $data['weapon_group'] ?? [],
    );
  }

  public function toAttributes(int $characterId): array
  {
    return [
      'character_id' => $characterId,
      'name' => $this->name,
      'min_str' => $this->minStr,
      'dmg' => $this->dmg,
      'attribute' => $this->attribute,
      'weight' => $this->weight,
      'ini_bonus' => $this->iniBonus,
      'special' => $this->special,
    ];
  }

}