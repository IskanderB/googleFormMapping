<?php

namespace App\File\Adapter;

use App\File\AbstractFilesystemAdapter;
use App\Service\User\GoogleUserService;
use App\Url\GoogleDocUrl;
use Google\Service\Drive\Permission;
use Masbug\Flysystem\GoogleDriveAdapter;

class GoogleFilesystemAdapter extends AbstractFilesystemAdapter
{
    public function __construct(
        string $storage,
        private GoogleDriveAdapter $adapter,
        private readonly GoogleUserService $googleUserService,
    ) {
        parent::__construct($storage);
    }

    public function write(string $path, string $content): void
    {
        parent::write($path, $content);

        $this->setPermission($this->getCloudId($path));
    }

    public function writeStream(string $path, $content): void
    {
        parent::writeStream($path, $content);

        $this->setPermission($this->getCloudId($path));
    }

    public function getDriver(): string
    {
        return 'google';
    }

    public function getShowUrl(string $path): ?string
    {
        return new GoogleDocUrl($this->getCloudId($path));
    }

    private function getCloudId(string $path): ?string
    {
        return $this->adapter->visibility($path)->path();
    }

    private function setPermission(string $cloudId): void
    {
        $emails = $this->googleUserService->getGoogleUserEmails();

        foreach ($emails as $email) {
            $permission = new Permission([
                'type' => 'user',
                'role' => 'writer',
                'emailAddress' => $email,
            ]);

            $this
                ->adapter
                ->getService()
                ->permissions
                ->create($cloudId, $permission, ['sendNotificationEmail' => false]);
        }
    }
}
