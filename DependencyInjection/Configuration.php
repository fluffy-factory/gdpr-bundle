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
                ->arrayNode('design')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('bg_color')->defaultValue('#292e33')->end()
                        ->scalarNode('text_color')->defaultValue('#ffffff')->end()
                        ->scalarNode('btn_deny_bg_color')->defaultValue('#D23A4B')->end()
                        ->scalarNode('btn_deny_text_color')->defaultValue('#D23A4B')->end()
                        ->scalarNode('btn_allow_bg_color')->defaultValue('#0ED198')->end()
                        ->scalarNode('btn_allow_text_color')->defaultValue('#0ED198')->end()
                    ->end()
                ->end()
            ->end()
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
