<?php

namespace Reaction\PM\Bootstraps;

/**
 * Interface HooksInterface
 * @package Reaction\PM\Bootstraps
 */
interface HooksInterface
{
    public function preHandle($app);

    public function postHandle($app);
}
