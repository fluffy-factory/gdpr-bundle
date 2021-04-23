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
                ->scalarNode('redirection_url')->defaultValue('fluffy_gdpr')->end()
            ->end()
            ->children()
                ->arrayNode('btn')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('deny')->defaultValue(true)->end()
                        ->booleanNode('accept')->defaultValue(true)->end()
                    ->end()
                ->end()
            ->end()
            ->children()
                ->arrayNode('design')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('disable')->defaultValue(false)->end()
                        ->scalarNode('bg_color')->defaultValue('#292e33')->end()
                        ->scalarNode('text_color')->defaultValue('#ffffff')->end()
                        ->scalarNode('btn_deny_bg_color')->defaultValue('#D23A4B')->end()
                        ->scalarNode('btn_deny_text_color')->defaultValue('#ffffff')->end()
                        ->scalarNode('btn_allow_bg_color')->defaultValue('#0ED198')->end()
                        ->scalarNode('btn_allow_text_color')->defaultValue('#ffffff')->end()
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
