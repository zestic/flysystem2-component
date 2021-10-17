<?php
declare(strict_types=1);

namespace Zestic\Flysystem;

final class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'factories' => [
                'AwsS3V3Adapter'                           =>
                    \Zestic\Flysystem\Factory\Adapter\AwsS3V3AdapterFactory::class,
                \League\Flysystem\Filesystem::class =>
                    \Zestic\Flysystem\Factory\FilesystemFactory::class,
            ],
        ];
    }
}
