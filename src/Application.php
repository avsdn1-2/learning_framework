<?php


namespace Framework;


use FastRoute\Dispatcher;
use Framework\Controller\AbstractController;
use Framework\Provider\ConfigServiceProvider;
use Framework\Provider\RouterServiceProvider;
use Pimple\Container;

class Application
{
    /** @var Container */
    private $container;

    public function __construct()
    {
        $this->initContainer();
    }


    public function run()
    {
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        /** @var Dispatcher $dispatcher */
        $dispatcher = $this->container['dispatcher'];
        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                // ... 404 Not Found
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                $this->callControllerAction($handler);

                break;
        }
    }

    private function initContainer()
    {
        $container = new Container();
        $container['config_dir'] = $this->getConfigurationDir();
        $container->register(new ConfigServiceProvider());
        $container->register(new RouterServiceProvider());

        $this->container = $container;
    }

    private function callControllerAction($controllerAction)
    {
        $part = explode('@', $controllerAction);
        $controllerClass = str_replace('/', '\\', $part[0]);
        $method = $part[1];

        /** @var AbstractController $controller */
        $controller = new $controllerClass();
        $controller->setContainer($this->container);
        return $controller->$method();
    }

    private function getConfigurationDir(): string
    {
        return __DIR__ . '/../config/';
    }
}