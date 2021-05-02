<?php

namespace Frame\Tests\Unit\Config;

use Frame\Config\Environment;
use Frame\Tests\Unit\BaseTestCase;

/**
 * @covers \Frame\Config\Environment
 */
class EnvironmentTest extends BaseTestCase
{
    public function testEnvironmentConfig(): void
    {
        $config = new Environment();
        $this->assertTrue($config->isDebugMode());
    }
}
