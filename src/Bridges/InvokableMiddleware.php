<?php

namespace Reaction\PM\Bridges;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use React\Promise\PromiseInterface;
use function Reaction\Promise\resolve;

class InvokableMiddleware implements BridgeInterface
{
    use BootstrapTrait;

    /**
     * {@inheritdoc}
     */
    public function bootstrap($appBootstrap, $appenv, $debug, $loader = null)
    {
        $this->bootstrapApplicationEnvironment($appBootstrap, $appenv, $debug);

        if (!is_callable($this->middleware)) {
            throw new \Exception('Middleware must implement callable');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function handle(ServerRequestInterface $request): PromiseInterface
    {
        $middleware = $this->middleware;
        /** @var ResponseInterface $response */
        $response = $middleware($request);
        return resolve($response);
    }
}
