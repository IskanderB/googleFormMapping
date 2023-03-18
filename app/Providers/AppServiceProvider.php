<?php

namespace App\Providers;

use App\File\Adapter\GoogleFilesystemAdapter;
use App\File\Adapter\LocalFilesystemAdapter;
use App\File\Adapter\TemporaryFilesystemAdapter;
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
        $this->app->alias(LocalFilesystemAdapter::class, 'layout.filesystem');
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
