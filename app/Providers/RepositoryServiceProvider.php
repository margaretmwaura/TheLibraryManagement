<?php

namespace App\Providers;

use App\Repository\BookRepository;
use App\Repository\Interfaces\BookRepositoryInterface;
use App\Repository\Interfaces\PermissionRepositoryInterface;
use App\Repository\Interfaces\RoleRepositoryInterface;
use App\Repository\PermissionRepository;
use App\Repository\RoleRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            BookRepositoryInterface::class,
            BookRepository::class
        );
        $this->app->bind(
            RoleRepositoryInterface::class,
            RoleRepository::class
        );
        $this->app->bind(
            PermissionRepositoryInterface::class,
            PermissionRepository::class
        );
    }
}
