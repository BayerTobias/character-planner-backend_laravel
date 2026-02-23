<?php

namespace App\Actions\Items;

use App\Models\Items\WeaponGroup;
use App\Repositories\Contracts\Items\WeaponGroupRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class GetWeaponGroupListAction
{
  public function __construct(
    private WeaponGroupRepositoryInterface $weaponGroupRepository
  ) {
  }

  /**
   * Retrieve all weapon groups.
   *
   * Returns a collection of WeaponGroup models from the repository.
   *
   * @return Collection<int, WeaponGroup>
   */
  public function execute(): Collection
  {
    return $this->weaponGroupRepository->getAll();
  }
}