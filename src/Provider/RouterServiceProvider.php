<?php


namespace Framework\Provider;


use FastRoute\RouteCollector;
use Framework\Config;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use function FastRoute\simpleDispatcher;

class RouterServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $configDir = $container['config_dir'];
        $config = new Config();
        $routes = $config->load($configDir . 'routes.ini');

        $dispatcher = simpleDispatcher(function (RouteCollector $routeCollector) use ($routes) {
            foreach ($routes as $route) {
                $routeCollector->addRoute($route['method'], $route['resource'], $route['handler']);
            }
        });

        $container['dispatcher'] = $dispatcher;
    }

}