<?php

namespace Reaction\PM\Bootstraps;

interface ApplicationEnvironmentAwareInterface
{
    public function initialize($appenv, $debug);
}
