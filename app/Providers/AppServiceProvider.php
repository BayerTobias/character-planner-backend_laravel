<?php

namespace App\Providers;

use App\Repositories\Contracts\Auth\UserRepositoryInterface;
use App\Repositories\Contracts\Character\CharacterClassRepositoryInterface;
use App\Repositories\Contracts\Character\CharacterRaceRepositoryInterface;
use App\Repositories\Contracts\Character\CharacterRepositoryInterface;
use App\Repositories\Contracts\Items\BaseArmorRepositoryInterface;
use App\Repositories\Contracts\Items\BaseWeaponRepositoryInterface;
use App\Repositories\Contracts\Items\WeaponGroupRepositoryInterface;
use App\Repositories\Eloquent\Auth\UserRepository;
use App\Repositories\Eloquent\Character\CharacterClassRepository;
use App\Repositories\Eloquent\Character\CharacterRaceRepository;
use App\Repositories\Eloquent\Character\CharacterRepository;
use App\Repositories\Eloquent\Items\BaseArmorRepository;
use App\Repositories\Eloquent\Items\BaseWeaponRepository;
use App\Repositories\Eloquent\Items\WeaponGroupRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            BaseArmorRepositoryInterface::class,
            BaseArmorRepository::class
        );

        $this->app->bind(
            BaseWeaponRepositoryInterface::class,
            BaseWeaponRepository::class
        );

        $this->app->bind(
            CharacterClassRepositoryInterface::class,
            CharacterClassRepository::class
        );

        $this->app->bind(
            CharacterRaceRepositoryInterface::class,
            CharacterRaceRepository::class
        );

        $this->app->bind(
            WeaponGroupRepositoryInterface::class,
            WeaponGroupRepository::class
        );

        $this->app->bind(
            CharacterRepositoryInterface::class,
            CharacterRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();
    }
}
