<?php

namespace App\File;

use App\Exceptions\FilesystemException;

interface FilesystemAdapterInterface
{
    /**
     * Записать файл
     *
     * @param string $path
     * @param string $content
     *
     * @return void
     *
     * @throws FilesystemException
     */
    public function write(string $path, string $content): void;

    /**
     * Записать стрим в файл
     *
     * @param string $path
     * @param resource $content
     *
     * @return void
     *
     * @throws FilesystemException
     */
    public function writeStream(string $path, $content): void;

    /**
     * Прочитать файл
     *
     * @param string $path
     *
     * @return string
     *
     * @throws FilesystemException
     */
    public function read(string $path): string;

    /**
     * Открыть стрим на чтение
     *
     * @param string $path
     *
     * @return resource
     *
     * @throws FilesystemException
     */
    public function readStream(string $path);

    /**
     * @return string
     */
    public function getDriver(): string;

    /**
     * @param string $path
     *
     * @return string|null
     */
    public function getCloudId(string $path): ?string;
}
