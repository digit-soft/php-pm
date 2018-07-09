<?php

namespace Reaction\PM\Bootstraps;

use Reaction\PM\Bridges\BridgeInterface;

/**
 * Class StaticBootstrap
 * @package Reaction\PM\Bootstraps
 */
abstract class StaticBootstrap implements BootstrapInterface
{
    /**
     * @var BridgeInterface
     */
    public $bridge;
}
