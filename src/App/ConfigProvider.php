<?php

declare(strict_types=1);

namespace App;

use App\Handler\BarHandler;
use App\Handler\FooHandler;
use Laminas\Stdlib\ArrayUtils\MergeReplaceKey;
use Mezzio\Swoole\Event\RequestEvent;
use Mezzio\Swoole\Event\RequestHandlerRequestListener;

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
        ];
    }

    public function getSwoole() : array
    {
        return [
            'swoole-http-server' => [
                'host'      => '0.0.0.0',
                'port'      => 9000,
                'listeners' => [
                    RequestEvent::class => new MergeReplaceKey(
                        [
                            RequestHandlerRequestListener::class,
                        ]
                    ),
                ],
            ],
        ];
    }
}
