<?php

namespace App\File\Adapter;

use App\File\AbstractFilesystemAdapter;
use Google\Service\Drive\Permission;
use Masbug\Flysystem\GoogleDriveAdapter;

class GoogleFilesystemAdapter extends AbstractFilesystemAdapter
{
    public function __construct(
        string $storage,
        private GoogleDriveAdapter $adapter,
    ) {
        parent::__construct($storage);
    }

    public function write(string $path, string $content): void
    {
        parent::write($path, $content);

        $this->setPermission($this->getCloudId($path));
    }

    public function getDriver(): string
    {
        return 'google';
    }

    public function getCloudId(string $path): ?string
    {
        return $this->adapter->visibility($path)->path();
    }

    private function setPermission(string $cloudId): void
    {
        $permission = new Permission([
            'type' => 'anyone',
            'role' => 'writer',
            'allowFileDiscovery' => false,
        ]);

        $this
            ->adapter
            ->getService()
            ->permissions
            ->create($cloudId, $permission);
    }
}
