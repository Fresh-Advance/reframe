<?php

namespace Frame\Config;

class Environment
{
    protected bool $debug = true;

    public function isDebugMode(): bool
    {
        return $this->debug;
    }
}
