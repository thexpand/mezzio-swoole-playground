<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container) : void {
    $app->get('/foo', App\Handler\FooHandler::class);
    $app->get('/bar', App\Handler\BarHandler::class);
};
