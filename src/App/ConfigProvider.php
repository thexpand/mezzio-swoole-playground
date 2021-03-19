<?php

declare(strict_types=1);

namespace App;

use App\Command\StartCommandFactory;
use App\Handler\BarHandler;
use App\Handler\FooHandler;
use Mezzio\Swoole\Command\StartCommand as MezzioSwooleStartCommand;

class ConfigProvider
{
    public function __invoke() : array
    {
        return [
            'dependencies'  => $this->getDependencies(),
            'mezzio-swoole' => $this->getSwoole(),
        ];
    }

    public function getDependencies() : array
    {
        return [
            'invokables' => [
                FooHandler::class => FooHandler::class,
                BarHandler::class => BarHandler::class,
            ],
            'factories'  => [
                MezzioSwooleStartCommand::class => StartCommandFactory::class,
            ],
        ];
    }

    public function getSwoole() : array
    {
        return [
            'swoole-http-server' => [
                'host' => '0.0.0.0',
                'port' => 9000,
            ],
        ];
    }
}
