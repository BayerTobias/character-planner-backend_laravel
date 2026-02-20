<?php

namespace App\Actions\Items;

use App\Repositories\Contracts\Items\BaseWeaponRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class GetBaseWeaponsListAction
{
  public function __construct(
    private BaseWeaponRepositoryInterface $baseWeaponRepository
  ) {
  }

  /**
   * Retrieve all base weapons.
   *
   * Returns a collection of BaseWeapon models from the repository.
   *
   * @return Collection<int, \App\Models\Items\BaseWeapon>
   */
  public function execute(): Collection
  {
    return $this->baseWeaponRepository->getAll();
  }
}