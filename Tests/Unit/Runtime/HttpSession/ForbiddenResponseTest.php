<?php

namespace Frame\Tests\Unit\Runtime\HttpSession;

use Frame\Runtime\HttpSession\ForbiddenResponse;
use Frame\Tests\Unit\BaseTestCase;

/**
 * @covers \Frame\Runtime\HttpSession\ForbiddenResponse
 */
class ForbiddenResponseTest extends BaseTestCase
{
    public function testDefaultConstructorArguments(): void
    {
        $response = new ForbiddenResponse();
        $this->assertSame(ForbiddenResponse::CODE_FORBIDDEN, $response->getCode());
        $this->assertSame(ForbiddenResponse::DEFAULT_MESSAGE, $response->getContent());
    }

    public function testFullConstructorArguments(): void
    {
        $response = new ForbiddenResponse("some message");
        $this->assertSame("some message", $response->getContent());
    }
}
