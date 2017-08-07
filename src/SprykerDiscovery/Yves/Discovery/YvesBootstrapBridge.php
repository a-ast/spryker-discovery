<?php

namespace Aa\SprykerDiscovery\Yves\Discovery;

use Symfony\Component\Routing\RouteCollection;

class YvesBootstrapBridge implements YvesBootstrapBridgeInterface
{
    /**
     * @var \ReflectionClass
     */
    private $bootstrapClass;

    private $bootstrap;

    /**
     * @var \Spryker\Shared\Kernel\Communication\Application
     */
    private $application;

    private function initialize()
    {
        $this->bootstrapClass = new \ReflectionClass('Pyz\Yves\Application\YvesBootstrap');
        $this->bootstrap = $this->bootstrapClass->newInstance();

        $applicationProperty = $this->bootstrapClass->getProperty('application');
        $applicationProperty->setAccessible(true);

        $this->application = $applicationProperty->getValue($this->bootstrap);

        $this->bootstrap->boot();
        $this->application->boot();
    }

    /**
     * @return RouteCollection
     */
    public function getRoutes()
    {
        $this->initialize();

        return $this->application['routes'];
    }
}