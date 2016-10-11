<?php

namespace AppBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package AppBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{

    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();
        $rootNode = $builder->root('app');

        $rootNode
          ->children()
            ->arrayNode('github_oauth')
                ->children()
                    ->scalarNode('client_id')->cannotBeEmpty()->end()
                    ->scalarNode('client_secret')->cannotBeEmpty()->end()
                ->end()
            ->end()
          ->end();

        return $builder;
    }
}