<?php

namespace Reaction\PM\Bridges;

use Psr\Http\Message\ServerRequestInterface;
use React\Promise\PromiseInterface;

interface BridgeInterface
{
    /**
     * Bootstrap an application
     *
     * @param string|null $appBootstrap The environment your application will use to bootstrap (if any)
     * @param string $appenv
     * @param boolean $debug If debug is enabled
     */
    public function bootstrap($appBootstrap, $appenv, $debug);

    /**
     * Handle the request and return a response.
     * @param ServerRequestInterface $request
     * @return PromiseInterface
     */
    public function handle(ServerRequestInterface $request): PromiseInterface;
}
