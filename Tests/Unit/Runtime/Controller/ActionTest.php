<?php

namespace Frame\Tests\Unit\Runtime\Controller;

use Frame\Runtime\Controller\Action;
use Frame\Tests\Unit\BaseTestCase;

/**
 * @covers \Frame\Runtime\Controller\Action
 */
class ActionTest extends BaseTestCase
{
    public function testMinimalConstructor(): void
    {
        $action = new Action("someConstructor");
        $this->assertSame("someConstructor", $action->getController());
        $this->assertSame(Action::DEFAULT_ACTION, $action->getAction());
        $this->assertSame([], $action->getParams());
    }

    public function testFullConstructor(): void
    {
        $params = ["param1", "param2"];
        $action = new Action("someConstructor", "someAction", $params);
        $this->assertSame("someConstructor", $action->getController());
        $this->assertSame("someAction", $action->getAction());
        $this->assertSame($params, $action->getParams());
    }

    public function testChaining(): void
    {
        $params = ["param1", "param2"];
        $action = new Action("someConstructor");

        $chainedResult = $action
            ->setAction("someAction")
            ->setParams($params);

        $this->assertInstanceOf(Action::class, $chainedResult);

        $this->assertSame("someConstructor", $action->getController());
        $this->assertSame("someAction", $action->getAction());
        $this->assertSame($params, $action->getParams());
    }

    public function testGetTitle(): void
    {
        $params = ["param1", "param2"];
        $action = new Action("someConstructor");

        $action
            ->setAction("someAction")
            ->setParams($params);

        $this->assertSame("someConstructor:someAction", $action->getTitle());
    }
}
