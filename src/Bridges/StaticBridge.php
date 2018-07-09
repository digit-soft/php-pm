<?php

namespace Reaction\PM\Bridges;

use Composer\Autoload\ClassLoader;
use Psr\Http\Message\ServerRequestInterface;
use React\Promise\PromiseInterface;
use Reaction\PM\ProcessSlave;
use function Reaction\Promise\resolve;
use RingCentral\Psr7;

class StaticBridge implements BridgeInterface
{
    /**
     * @var ProcessSlave
     */
    public $slave;
    /**
     * @var ClassLoader
     */
    public $loader;

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
    public function handle(ServerRequestInterface $request): PromiseInterface
    {
        $response = new Psr7\Response(404, ['Content-type' => 'text/plain'], 'Not found');
        return resolve($response);
    }
}
