# Spryker discovery

Spryker module that helps in project development. 

### How to install

1. Install module

2. Extend a list of core namespaces
```php
// config/Shared/config_default.php
$config[KernelConstants::CORE_NAMESPACES] = [
    'SprykerEco',
    'Spryker',
    'Aa\\SprykerDiscovery',
];
```

3. Register command
```php
// src/Pyz/Zed/Console/ConsoleDependencyProvider.php

    public function getConsoleCommands(Container $container)
    {
        ...
        $commands[] = new DumpRoutesConsole();
        ...
    }

```


