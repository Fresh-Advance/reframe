<?php

namespace Frame\Tests\Unit\Runtime\HttpSession;

use Frame\Runtime\HttpSession\NotFoundResponse;
use Frame\Tests\Unit\BaseTestCase;

/**
 * @covers \Frame\Runtime\HttpSession\NotFoundResponse
 */
class NotFoundResponseTest extends BaseTestCase
{
    public function testDefaultConstructorArguments(): void
    {
        $response = new NotFoundResponse();
        $this->assertSame(NotFoundResponse::CODE_NOT_FOUND, $response->getCode());
        $this->assertSame(NotFoundResponse::DEFAULT_MESSAGE, $response->getContent());
    }

    public function testFullConstructorArguments(): void
    {
        $response = new NotFoundResponse("some message");
        $this->assertSame("some message", $response->getContent());
    }
}
