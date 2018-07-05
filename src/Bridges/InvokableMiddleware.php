<?php

namespace Reaction\PM\Bridges;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class InvokableMiddleware implements BridgeInterface
{
    use BootstrapTrait;

    /**
     * {@inheritdoc}
     */
    public function bootstrap($appBootstrap, $appenv, $debug)
    {
        $this->bootstrapApplicationEnvironment($appBootstrap, $appenv, $debug);

        if (!is_callable($this->middleware)) {
            throw new \Exception('Middleware must implement callable');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $middleware = $this->middleware;
        /** @var ResponseInterface $response */
        $response = $middleware($request);
        return $response;
    }
}
