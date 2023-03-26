<?php

namespace App\Providers;

use LaravelDoctrine\ORM\DoctrineServiceProvider as LaravelDoctrineServiceProvider;

class DoctrineServiceProvider extends LaravelDoctrineServiceProvider
{
    public function register(): void
    {
        parent::register();

        $this->registerDoctrineTypeMapping();
    }

    private function registerDoctrineTypeMapping(): void
    {
        $databasePlatform = $this->app->make('registry')->getConnection()->getDatabasePlatform();
        $entityManagers = $this->app->make('config')->get('doctrine.managers');
        foreach ($entityManagers as $entityManager) {
            if (!array_key_exists('type_mappings', $entityManager)) {
                continue;
            }
            foreach ($entityManager['type_mappings'] as $dbType => $doctrineName) {
                $databasePlatform->registerDoctrineTypeMapping($dbType, $doctrineName);
            }
        }
    }
}
