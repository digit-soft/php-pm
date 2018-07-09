<?php

namespace Reaction\PM\Bootstraps;

use Reaction\PM\Bridges\BridgeInterface;

/**
 * Interface BootstrapInterface
 * @package Reaction\PM\Bootstraps
 * @property BridgeInterface $bridge
 */
interface BootstrapInterface
{
    /**
     * Get Application
     * @return mixed
     */
    public function getApplication();
}
