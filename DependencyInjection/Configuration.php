<?php

namespace FluffyFactory\Bundle\GdprBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('fluffy_gdpr');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('cookies')
                    ->prototype('array')
                        ->children()
                            ->booleanNode('required')->defaultValue(true)->end()
                            ->scalarNode('name')->cannotBeEmpty()->end()
                            ->scalarNode('description')->cannotBeEmpty()->end()
                            ->scalarNode('detail')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
