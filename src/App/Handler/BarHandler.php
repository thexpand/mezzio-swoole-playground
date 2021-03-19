<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class BarHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        return new JsonResponse(
            [
                'message'    => 'You have hit the Bar',
                'requestUri' => $request->getUri()->getPath(),
                'test_env'   => $_ENV['TEST_ENV_VAR'],
            ]
        );
    }
}
