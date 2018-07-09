<?php

namespace Reaction\PM\Bootstraps;

use React\EventLoop\LoopInterface;

class ReactionBootstrap extends StaticBootstrap implements ApplicationEnvironmentAwareInterface
{
    /**
     * @inheritdoc
     */
    public function initialize($appEnv, $debug)
    {
        $slave = $this->bridge->slave;

        \Reaction::initBasic($slave->getLoader());
        //Set external event loop
        \Reaction::$di->setSingleton(LoopInterface::class, $slave->getLoop());
        //Set external event loop flag
        \Reaction::$config->set('appStatic.loopIsExternal', true);
        \Reaction::initStaticApp();
        \Reaction::$app->initRouter();
        \Reaction::$app->run();
    }

    /**
     * @inheritdoc
     */
    public function getApplication()
    {
        return \Reaction::$app;
    }
}
