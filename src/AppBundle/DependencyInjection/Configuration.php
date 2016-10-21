<?php

namespace AppBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
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

        // GitHub.
        $rootNode
          ->children()
            ->append($this->configureGitHubNode())
          ->end();

        // Dashboard.
        $rootNode
          ->children()
            ->arrayNode('dashboard')
                ->isRequired()
                ->fixXmlConfig('module')
                ->children()
                    ->arrayNode('modules')
                        ->prototype('array')
                            ->ignoreExtraKeys()
                            ->children()
                                ->scalarNode('label')->end()
                                ->scalarNode('icon')->end()
                                ->append($this->appendDashboardActionsNode())
                                ->append($this->appendDashboardChildren())
                            ->end()
                        ->end()
                    ->end()
                ->end()
          ->end()
        ;

        return $builder;
    }

    public function configureGitHubNode() {

        $builder = new TreeBuilder();
        /**
         * @var ArrayNodeDefinition
         */
        $gitHubNode = $builder->root('github_oauth');

        $gitHubNode
          ->children()
            ->scalarNode('client_id')->cannotBeEmpty()->end()
            ->scalarNode('client_secret')->cannotBeEmpty()->end()
          ->end()
        ;

        return $gitHubNode;
    }

    public function appendDashboardActionsNode() {

        $builder = new TreeBuilder();
        /**
         * @var ArrayNodeDefinition $actionsNode
         */
        $actionsNode = $builder->root('actions');

        $actionsNode
            ->prototype('array')
            ->ignoreExtraKeys()
                ->children()
                    ->scalarNode('label')->end()
                    ->scalarNode('route')->end()
                    ->scalarNode('icon')->end()
                ->end()
            ->end()
        ;

        return $actionsNode;
    }

    public function appendDashboardChildren() {

        $builder = new TreeBuilder();
        /**
         * @var ArrayNodeDefinition $actionsNode
         */
        $childrenNode = $builder->root('children');

        $childrenNode
          ->prototype('array')
          ->ignoreExtraKeys()
            ->children()
                ->scalarNode('label')->end()
                ->scalarNode('icon')->end()
                ->append($this->appendDashboardActionsNode())
            ->end()
          ->end()
        ;

        return $childrenNode;
    }
}