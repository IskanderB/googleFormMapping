<?php

namespace App\Providers;

use App\Enum\Role;
use App\File\Adapter\GoogleFilesystemAdapter;
use App\File\Adapter\LocalFilesystemAdapter;
use App\File\Adapter\TemporaryFilesystemAdapter;
use App\Http\Middleware\IsAdmin;
use App\Service\Lock\LockService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->alias(GoogleFilesystemAdapter::class, 'layout.filesystem');
        $this->app->when('layout.filesystem')
            ->needs('$storage')
            ->give('layout');

        $this->app->alias(GoogleFilesystemAdapter::class, 'document.filesystem');
        $this->app->when('document.filesystem')
            ->needs('$storage')
            ->give('document');

        $this->app->alias(TemporaryFilesystemAdapter::class, 'temporary.filesystem');
        $this->app->when('temporary.filesystem')
            ->needs('$storage')
            ->give('temporary');

        $this->app->bind(LockService::class, function (Application $app) {
            return new LockService(env('LOCK_TIME', 5));
        });

        $this->app->bind(IsAdmin::class, function (Application $app) {
            return new IsAdmin(Role::ROLE_ADMIN);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
