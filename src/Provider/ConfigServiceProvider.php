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
        $container['app.template_dir'] = $container['app.config']['framework']['template_path'];
        $container['app.cache_dir'] = $container['app.config']['framework']['cache_path'];
    }

}