<?php
declare(strict_types=1);

namespace IamPersistent\Flysystem\Factory;

use ConfigValue\GatherConfigValues;
use League\Flysystem\Filesystem;
use Psr\Container\ContainerInterface;

final class FilesystemFactory
{
    public function __invoke(ContainerInterface $container): Filesystem
    {
        $config = (new GatherConfigValues)($container, 'flysystem');
        $adapterName = $config['adapter'];
        $adapter = $container->get($adapterName);

        return new Filesystem($adapter);
    }
}
