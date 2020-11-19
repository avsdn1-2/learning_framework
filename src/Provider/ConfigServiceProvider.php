<?php


namespace Framework\Provider;


use Framework\Config;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ConfigServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $configDir = $container['config_dir'];
        $config = new Config();
        $container['app.config'] = $config->load($configDir . 'app.ini');
    }

}