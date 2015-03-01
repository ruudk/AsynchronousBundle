<?php

namespace SimpleBus\AsynchronousBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @var string
     */
    private $alias;

    public function __construct($alias)
    {
        $this->alias = $alias;
    }

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root($this->alias);

        $rootNode
            ->children()
                ->scalarNode('message_serializer_service_id')
                    ->info('Service id of an instance of MessageSerializer')
                    ->isRequired()
                ->end()
                ->arrayNode('commands')
                    ->canBeEnabled()
                    ->children()
                        ->scalarNode('publisher_service_id')
                            ->info('Service id of an instance of Publisher')
                            ->isRequired()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('events')
                    ->canBeEnabled()
                    ->children()
                        ->scalarNode('publisher_service_id')
                            ->info('Service id of an instance of Publisher')
                            ->isRequired()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}