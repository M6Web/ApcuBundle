<?php

namespace M6Web\Bundle\ApcuBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Loads and manages bundle configuration
 */
class M6WebApcuExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        foreach ($config as $serviceId => $parameters) {
            $container
                ->register(
                    sprintf('m6web_apcu.%s', $serviceId),
                    $parameters['class']
                )
                ->addArgument($parameters['namespace'])
                ->addArgument($parameters['ttl']);
        }
    }

    /**
     * Get bundle alias
     *
     * @return string
     */
    public function getAlias()
    {
        return 'm6web_apcu';
    }
}
