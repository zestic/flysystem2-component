<?php
declare(strict_types=1);

namespace Zestic\Flysystem;

use League\Flysystem\Filesystem;

final class Files
{
    public function __construct(
        private Filesystem $filesystem,
        private string $url,
    ) { }

    public function fileExists(string $location): bool
    {
        return $this->filesystem->fileExists($location);
    }

    public function getFileSize(string $location): int
    {
        return $this->filesystem->fileSize($location);
    }

    public function getMimeType(string $location): string
    {
        return $this->filesystem->mimeType($location);
    }

    public function read(string $location): string
    {
        return $this->filesystem->read($location);
    }

    public function readStream(string $location)
    {
        return $this->filesystem->readStream($location);
    }

    public function write(string $location, string $contents, array $config = []): string
    {
        $this->filesystem->write($location, $contents, $config);

        return $this->getUrl($location);
    }

    private function getUrl(string $location): string
    {
        return $this->url . '/' . $location;
    }
}
