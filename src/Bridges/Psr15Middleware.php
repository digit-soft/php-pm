<?php

namespace Reaction\PM\Bridges;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use React\Promise\PromiseInterface;
use function Reaction\Promise\resolve;

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
    public function handle(ServerRequestInterface $request): PromiseInterface
    {
        return resolve($this->middleware->handle($request));
    }
}
