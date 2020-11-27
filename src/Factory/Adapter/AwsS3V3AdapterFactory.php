<?php
declare(strict_types=1);

namespace IamPersistent\Flysystem\Factory\Adapter;

use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use Psr\Container\ContainerInterface;

final class AwsS3V3AdapterFactory
{
    public function __invoke(ContainerInterface $container): AwsS3V3Adapter
    {
        return new AwsS3V3Adapter();
    }
}
