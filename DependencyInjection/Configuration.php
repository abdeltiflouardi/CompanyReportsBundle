<?php

namespace OS\CompanyReportsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('os_company_reports');

        // Services configuation
        $this->addServicesSection($rootNode);

        return $treeBuilder;
    }

    private function addServicesSection(ArrayNodeDefinition $rootNode)
    {
        $rootNode
                ->fixXmlConfig('rule', 'webservices')
                ->children()
                    ->arrayNode('webservices')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('webservice')->defaultNull()->end()
                            ->scalarNode('login')->defaultNull()->end()
                            ->scalarNode('password')->defaultNull()->end()                
                            ->scalarNode('country')->defaultNull()->end()
                            ->scalarNode('locale')->defaultNull()->end()
                        ->end()
                    ->end()
                ->end()     
        ;
    }

}
