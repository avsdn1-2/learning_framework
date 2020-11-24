<?php


namespace Framework\Provider;

use PDO;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\Debug\Debug;

class DatabaseServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $config = $container['app.config']['db'];

        $pdo = new PDO(
            sprintf('mysql:host=%s;dbname=%s',
            $config['host'],
            $config['db_name']
        ), $config['user'], $config['password']);
        $container['app.db'] = $pdo;
    }

}