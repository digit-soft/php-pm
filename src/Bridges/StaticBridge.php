<?php

namespace Reaction\PM\Bridges;

use Psr\Http\Message\ServerRequestInterface;
use React\Promise\PromiseInterface;
use function Reaction\Promise\resolve;
use RingCentral\Psr7;

class StaticBridge implements BridgeInterface
{
    /**
     * {@inheritdoc}
     */
    public function bootstrap($appBootstrap, $appenv, $debug, $loader = null)
    {
        // empty
    }

    /**
     * {@inheritdoc}
     */
    public function handle(ServerRequestInterface $request): PromiseInterface
    {
        $response = new Psr7\Response(404, ['Content-type' => 'text/plain'], 'Not found');
        return resolve($response);
    }
}
