<?php
declare(strict_types=1);

namespace IamPersistent\Flysystem\Factory;

use ConfigValue\GatherConfigValues;
use IamPersistent\Flysystem\Factory\Adapter\AwsS3V3AdapterFactory;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemAdapter;
use Psr\Container\ContainerInterface;

final class FilesystemFactory
{
    /** @var string */
    private $system = 'default';

    public function __construct(string $system)
    {
        $this->system = $system;
    }

    public function __invoke(ContainerInterface $container): Filesystem
    {
        $config = (new GatherConfigValues)($container, 'flysystem');
        $systemConfig = $config[$this->system];
        $adapterFactory = $this->getAdapterFactory($systemConfig['adapter']);
        $adapter = $adapterFactory($container);

        return new Filesystem($adapter);
    }

    private function getAdapterFactory(string $adapter)
    {
        switch ($adapter) {
            case 'AwsS3V3':
                return new AwsS3V3AdapterFactory($this->system);
        }
    }
}
