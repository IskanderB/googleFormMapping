<?php

namespace App\File;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Config;
use InvalidArgumentException;
use LogicException;

class FilesystemFactory
{
    public function __construct(
        private Application $application,
    ) {
    }

    public function get(string $storage): FilesystemAdapterInterface
    {
        $aliasName = $this->getAliasName($storage);

        if (!$this->application->has($aliasName)) {
            throw new InvalidArgumentException(sprintf('Не найдена файловая система: %s', $storage));
        }

        $filesystem = $this->application->get($aliasName);

        if (!($filesystem instanceof FilesystemAdapterInterface)) {
            throw new LogicException(
                message: sprintf(
                    'Класс: %s, не наследует %s',
                    get_class($filesystem),
                    FilesystemAdapterInterface::class,
                ),
            );
        }

        if ($filesystem->getDriver() !== $this->getDriver($storage))
        {
            throw new LogicException(
                message: sprintf(
                    'Драйвер файловой системы: %s, конфликтует с драйвером хранилища %s',
                    get_class($filesystem),
                    $storage,
                ),
            );
        }

        return $filesystem;
    }

    private function getDriver(string $storage): string
    {
        return Config::get(sprintf('filesystems.disks.%s.driver', $storage));
    }

    private function getAliasName(string $storage): string
    {
        return "{$storage}.filesystem";
    }
}
