<?php

namespace AppBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

/**
 * Class AppExtension
 * @package AppBundle\DependencyInjection
 */
class AppExtension extends Extension
{
    /**
     * Loads a specific configuration.
     *
     * @param array $configs An array of configuration values
     * @param ContainerBuilder $container A ContainerBuilder instance
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        if (isset($config['github_oauth'])) {
            $container->setParameter(
              'github.oauth.client_id',
              $config['github_oauth']['client_id']
            );
            $container->setParameter(
              'github.oauth.client_secret',
              $config['github_oauth']['client_secret']
            );
        }
    }
}