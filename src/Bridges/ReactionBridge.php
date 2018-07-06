<?php

namespace Reaction\PM\Bridges;

use React\Promise\PromiseInterface;
use Reaction\PM\Bootstraps\ApplicationEnvironmentAwareInterface;
use Reaction\PM\Bootstraps\BootstrapInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Reaction\RequestApplicationInterface;
use Reaction\StaticApplicationInterface;
use RingCentral\Psr7;


class ReactionBridge implements BridgeInterface
{
    /**
     * An application implementing the HttpKernelInterface
     *
     * @var StaticApplicationInterface
     */
    protected $application;

    /**
     * @var BootstrapInterface
     */
    protected $bootstrap;

    /**
     * @var string[]
     */
    protected $tempFiles = [];

    /**
     * Bootstrap an application implementing the HttpKernelInterface.
     *
     * In the process of bootstrapping we decorate our application with any number of
     * *middlewares* using StackPHP's Stack\Builder.
     *
     * The app bootstraping itself is actually proxied off to an object implementing the
     * Reaction\PM\Bridges\BridgeInterface interface which should live within your app itself and
     * be able to be autoloaded.
     *
     * @param string $appBootstrap The name of the class used to bootstrap the application
     * @param string|null $appenv The environment your application will use to bootstrap (if any)
     * @param boolean $debug If debug is enabled
     */
    public function bootstrap($appBootstrap, $appenv, $debug)
    {
        //error_log(print_r([], true));
        //\Reaction::init(getcwd() . '/Config');
        //error_log(getcwd() . '/Config' . "\n\n");
        $appBootstrap = $this->normalizeAppBootstrap($appBootstrap);

        $this->bootstrap = new $appBootstrap();
        if ($this->bootstrap instanceof ApplicationEnvironmentAwareInterface) {
            $this->bootstrap->initialize($appenv, $debug);
        }
        if ($this->bootstrap instanceof BootstrapInterface) {
            $this->application = $this->bootstrap->getApplication();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function handle(ServerRequestInterface $request): PromiseInterface
    {
        $app = $this->application->createRequestApplication($request);
        return $app->handleRequest()->then(function($data = null) {
            return $data;
        }, function() {
            error_log('Error');
        });

        return new Psr7\Response(200, [], 'test body');
        if (null === $this->application) {
            // internal server error
            return new Psr7\Response(500, ['Content-type' => 'text/plain'], 'Application not configured during bootstrap');
        }
    }
    /**
     * @param $appBootstrap
     * @return string
     * @throws \RuntimeException
     */
    protected function normalizeAppBootstrap($appBootstrap)
    {
        $appBootstrap = str_replace('\\\\', '\\', $appBootstrap);

        $bootstraps = [
            $appBootstrap,
            '\\' . $appBootstrap,
            '\\Reaction\\PM\Bootstraps\\' . ucfirst($appBootstrap)
        ];

        foreach ($bootstraps as $class) {
            if (class_exists($class)) {
                return $class;
            }
        }
    }
}
