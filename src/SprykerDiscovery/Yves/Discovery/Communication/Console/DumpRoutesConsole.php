<?php

namespace Aa\SprykerDiscovery\Yves\Discovery\Communication\Console;

use Aa\SprykerDiscovery\Yves\Discovery\DiscoveryFactory;
use Aa\SprykerDiscovery\Yves\Discovery\YvesBootstrapBridge;
use Aa\SprykerDiscovery\Yves\Discovery\YvesBootstrapBridgeInterface;
use Silex\ControllerCollection;
use Spryker\Yves\Kernel\ClassResolver\Factory\FactoryResolver;
use Spryker\Yves\Kernel\FactoryInterface;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Routing\RouteCollection;


class DumpRoutesConsole extends Console
{

    const COMMAND_NAME = 'aa:dump:routes';

    /**
     * @return void
     */
    protected function configure()
    {
        parent::configure();

        $this->setName(static::COMMAND_NAME)
            ->setHelp('<info>' . static::COMMAND_NAME . ' -h</info>')
            ->setDescription('');

    }

    /**
     * @var DiscoveryFactory
     */
    protected function getYvesFactory()
    {
        $resolver = new FactoryResolver();

        return $resolver->resolve($this);
    }


    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $bootstrapBridge = $this->getBootstrapBridge();

        $routes = $bootstrapBridge->getRoutes();

        $table = new Table($output);
        $this->fillTable($table, $routes);

        $table->render();
    }

    protected function fillTable(Table $table, RouteCollection $routes): void
    {
        $table->setHeaders([
            'Path', 'Host', 'Def',
        ]);

        foreach ($routes as $route) {

            $actionName = $route->getDefaults()['_controller'];
            $actionName = str_replace('controller.service.', '', $actionName);

            $table->addRow([
                $route->getPath(),
                $route->getHost(),
                $actionName,
            ]);
        }
    }

    protected function getBootstrapBridge(): YvesBootstrapBridgeInterface
    {
        $factory = $this->getYvesFactory();
        $bootstrapBridge = $factory->createYvesBootstrapBridge();
        return $bootstrapBridge;
    }
}
