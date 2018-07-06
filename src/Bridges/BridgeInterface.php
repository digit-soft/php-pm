<?php

namespace Reaction\PM\Bridges;

use Composer\Autoload\ClassLoader;
use Psr\Http\Message\ServerRequestInterface;
use React\Promise\PromiseInterface;

interface BridgeInterface
{
    /**
     * Bootstrap an application
     *
     * @param string|null      $appBootstrap The environment your application will use to bootstrap (if any)
     * @param string           $appenv
     * @param boolean          $debug If debug is enabled
     * @param ClassLoader|null $loader
     * @return
     */
    public function bootstrap($appBootstrap, $appenv, $debug, $loader = null);

    /**
     * Handle the request and return a response.
     * @param ServerRequestInterface $request
     * @return PromiseInterface
     */
    public function handle(ServerRequestInterface $request): PromiseInterface;
}
