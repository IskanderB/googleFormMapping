<?php

namespace App\Providers;

use App\Exceptions\FilesystemException;
use Google\Client;
use Google\Service\Drive;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use League\Flysystem\Visibility;
use Masbug\Flysystem\GoogleDriveAdapter;
use Throwable;

class GoogleDriveServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot(){
        try {
            $this->app->bind(GoogleDriveAdapter::class, function (Application $app) {
                $config = Config::get('filesystems.disks.google');

                $options = [];

                if (!empty($config['teamDriveId'] ?? null)) {
                    $options['teamDriveId'] = $config['teamDriveId'];
                }

                $client = new Client();
                $client->setClientId($config['clientId']);
                $client->setClientSecret($config['clientSecret']);
                $client->refreshToken($config['refreshToken']);

                $client->useApplicationDefaultCredentials();
                $client->addScope(Drive::DRIVE);
                $client->setSubject('google-sheet-api@form-mapping-379421.iam.gserviceaccount.com');

                $service = new Drive($client);

                return new GoogleDriveAdapter($service, $config['folder'] ?? '/', $options);
            });

            Storage::extend('google', function(Application $app) {
                $adapter = $app->get(GoogleDriveAdapter::class);

                $driver = new Filesystem($adapter, [\League\Flysystem\Config::OPTION_VISIBILITY => Visibility::PUBLIC]);

                return new FilesystemAdapter($driver, $adapter);
            });
        } catch(Throwable $throwable) {
            throw new FilesystemException($throwable->getMessage(), $throwable);
        }
    }
}
