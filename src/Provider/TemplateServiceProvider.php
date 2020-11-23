<?php


namespace Framework\Provider;


use Framework\Application;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TemplateServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        /** @var Application $app */
        $app = $container['app'];

        $templatePath = $app->getTemplatePath();
        $cachePath = $app->getCachePath();
        $loader = new FilesystemLoader($templatePath);
        $templateEngine = new Environment($loader, [
            'cache' => $cachePath,
            'debug' => true
        ]);
        $container['app.template_engine'] = $templateEngine;
    }

}