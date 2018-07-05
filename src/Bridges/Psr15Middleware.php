<?php

namespace Reaction\PM\Bridges;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;

class Psr15Middleware implements BridgeInterface
{
    use BootstrapTrait;

    /**
     * {@inheritdoc}
     */
    public function bootstrap($appBootstrap, $appenv, $debug)
    {
        $this->bootstrapApplicationEnvironment($appBootstrap, $appenv, $debug);

        if (!$this->middleware instanceof RequestHandlerInterface) {
            throw new \Exception('Middleware must implement RequestHandlerInterface');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->middleware->handle($request);
    }
}
