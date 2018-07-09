<?php

namespace Reaction\PM\Bootstraps;

interface ApplicationEnvironmentAwareInterface
{
    /**
     * Initialize application bootstrap with given debug status and environment name
     * @param string $appEnv
     * @param bool $debug
     */
    public function initialize($appEnv, $debug);
}
