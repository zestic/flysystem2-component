<?php
declare(strict_types=1);

namespace IamPersistent\Flysystem\Factory\Adapter;

use ConfigValue\GatherConfigValues;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use Psr\Container\ContainerInterface;

final class AwsS3V3AdapterFactory
{
    public function __invoke(ContainerInterface $container): AwsS3V3Adapter
    {
        $config = (new GatherConfigValues)($container, 'flysystem');
        $config = $config['s3'];

        $client = new Aws\S3\S3Client($options);

        $bucket = $config['bucket'];
        $prefix = $config['prefix'] ?? '';

        return new AwsS3V3Adapter(
            $client,
            $bucket,
            $prefix
        );
    }
}
