<?php

namespace Reaction\PM\Bridges;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RingCentral\Psr7;

class StaticBridge implements BridgeInterface
{
    /**
     * {@inheritdoc}
     */
    public function bootstrap($appBootstrap, $appenv, $debug)
    {
        // empty
    }

    /**
     * {@inheritdoc}
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new Psr7\Response(404, ['Content-type' => 'text/plain'], 'Not found');
    }
}
