<?php

namespace Reaction\PM\Bootstraps;


class ReactionBootstrap implements BootstrapInterface, ApplicationEnvironmentAwareInterface
{

    public function initialize($appenv, $debug, $loader = null)
    {
        \Reaction::init($loader);
        \Reaction::$app->initRouter();
        \Reaction::$app->run();
    }

    public function getApplication()
    {
        return \Reaction::$app;
    }
}
