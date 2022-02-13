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
