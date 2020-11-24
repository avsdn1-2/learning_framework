<?php


namespace Framework\Model;


use Framework\Container\ContainerTrait;
use Pimple\Container;

class ModelFactory
{
    static public function make(string $className, Container $container): AbstractModel
    {
        /** @var AbstractModel $model */
        $model = new $className();
        $model->setContainer($container);

        return $model;
    }
}