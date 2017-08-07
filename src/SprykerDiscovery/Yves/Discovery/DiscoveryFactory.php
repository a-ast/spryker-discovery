<?php

namespace Aa\SprykerDiscovery\Yves\Discovery;

use Spryker\Yves\Kernel\AbstractFactory;

class DiscoveryFactory extends AbstractFactory
{

    /**
     * @var YvesBootstrapBridgeInterface
     */
    public function createYvesBootstrapBridge()
    {
        return new YvesBootstrapBridge();
    }
}
