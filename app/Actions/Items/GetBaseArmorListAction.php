<?php

namespace App\Actions\Items;

use App\Repositories\Contracts\Items\BaseArmorRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class GetBaseArmorListAction
{
  public function __construct(
    private BaseArmorRepositoryInterface $baseArmorRepository
  ) {
  }

  /**
   * Retrieve all base armors.
   *
   * Returns a collection of BaseArmor models from the repository.
   *
   * @return Collection<int, \App\Models\Items\BaseArmor>
   */
  public function execute(): Collection
  {
    return $this->baseArmorRepository->getAll();
  }
}