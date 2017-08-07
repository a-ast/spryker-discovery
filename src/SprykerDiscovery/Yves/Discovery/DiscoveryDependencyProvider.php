<?php

namespace Aa\SprykerDiscovery\Yves\Discovery;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class DiscoveryDependencyProvider extends AbstractBundleDependencyProvider
{
    public function provideDependencies(Container $container)
    {
        return $container;
    }
}
