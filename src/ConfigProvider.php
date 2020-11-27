<?php
declare(strict_types=1);

namespace IamPersistent\Flysystem;

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
                'AwsS3V3'                             =>
                    \IamPersistent\Flysystem\Factory\Adapter\AwsS3V3AdapterFactory::class,
            ],
        ];
    }
}
