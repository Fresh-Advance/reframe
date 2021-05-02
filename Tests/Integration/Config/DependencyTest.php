<?php

namespace Frame\Tests\Integration\Config;

use Frame\Config\Dependency;
use Frame\Runtime\HttpSession\Request;
use Frame\Tests\Unit\BaseTestCase;
use FreshAdvance\Dependency\Container;

/**
 * @covers \Frame\Config\Dependency
 */
class DependencyTest extends BaseTestCase
{
    public function testGetRequest(): void
    {
        $diContainer = new Container(new Dependency());
        $request = $diContainer->get('Request');

        $this->assertInstanceOf(Request::class, $request);
    }

    public function testGetRouter(): void
    {
        $diContainer = new Container(new Dependency());
        $router = $diContainer->get('Router');

        $this->assertInstanceOf(Container::class, $router);
    }

    public function testGetEnvironmentConfig(): void
    {
        $diContainer = new Container(new Dependency());
        $environmentConfig = $diContainer->get('Config/Environment');

        $this->assertInstanceOf(\Frame\Config\Environment::class, $environmentConfig);
    }
}
