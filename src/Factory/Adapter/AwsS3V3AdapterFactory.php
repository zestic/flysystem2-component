<?php
declare(strict_types=1);

namespace Zestic\Flysystem\Factory\Adapter;

use Aws\S3\S3Client;
use ConfigValue\GatherConfigValues;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use Psr\Container\ContainerInterface;

final class AwsS3V3AdapterFactory
{
    public function __construct(
        private string $system = 'default'
    ) {
    }

    public function __invoke(ContainerInterface $container): AwsS3V3Adapter
    {
        $flysystemConfig = (new GatherConfigValues)($container, 'flysystem');
        $config = $flysystemConfig[$this->system];

        $args = [
            'credentials' => [
                'key'    => $config['key'],
                'secret' => $config['secret'],
            ],
            'endpoint'    => $config['endpoint'],
            'region'      => $config['region'],
            'version'     => $config['version'] ?? 'latest',
        ];

        $client = new S3Client($args);

        $bucket = $config['bucket'];
        $prefix = $config['prefix'] ?? '';
        $visibility = $config['visibility'] ?
            new \League\Flysystem\AwsS3V3\PortableVisibilityConverter(
                $config['visibility']
            ) : null;

        return new AwsS3V3Adapter(
            $client,
            $bucket,
            $prefix,
            $visibility
        );
    }
}
