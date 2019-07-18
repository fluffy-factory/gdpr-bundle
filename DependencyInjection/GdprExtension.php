<?php

namespace FluffyFactory\Bundle\GdprBundle\DependencyInjection;

use FluffyFactory\Bundle\GdprBundle\Model\Cookie;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class GdprExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');

        $container->setParameter('fluffy.gdpr.redirection_url', $config['redirection_url']);
        $container->setParameter('fluffy.gdpr.design', $config['design']);
        $container->setParameter('fluffy.gdpr.cookies', $config);
    }
}
