<?php

namespace Aa\SprykerDiscovery\Yves\Discovery;

use Symfony\Component\Routing\RouteCollection;

interface YvesBootstrapBridgeInterface
{
    /**
     * @return RouteCollection
     */
    public function getRoutes();
}