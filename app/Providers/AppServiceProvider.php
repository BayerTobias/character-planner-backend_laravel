<?php

namespace App\Providers;

use App\Repositories\Contracts\Auth\UserRepositoryInterface;
use App\Repositories\Contracts\Character\CharacterClassRepositoryInterface;
use App\Repositories\Contracts\Items\BaseArmorRepositoryInterface;
use App\Repositories\Contracts\Items\BaseWeaponRepositoryInterface;
use App\Repositories\Eloquent\Auth\UserRepository;
use App\Repositories\Eloquent\Character\CharacterClassRepository;
use App\Repositories\Eloquent\Items\BaseArmorRepository;
use App\Repositories\Eloquent\Items\BaseWeaponRepository;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();
    }
}
