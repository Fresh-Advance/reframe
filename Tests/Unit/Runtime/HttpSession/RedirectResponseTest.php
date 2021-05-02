<?php

namespace Frame\Tests\Unit\Runtime\HttpSession;

use Frame\Runtime\HttpSession\RedirectResponse;
use Frame\Tests\Unit\BaseTestCase;

/**
 * @covers \Frame\Runtime\HttpSession\RedirectResponse
 */
class RedirectResponseTest extends BaseTestCase
{
    public function testDefaultConstructorArguments(): void
    {
        $urlExample = "someUrl/someSubUrl";
        $response = new RedirectResponse($urlExample);
        $this->assertSame(RedirectResponse::CODE_FOUND, $response->getCode());
        $this->assertSame([
            ["Location: {$urlExample}", true]
        ], $response->getHeaders());
    }

    public function testFullConstructorArguments(): void
    {
        $urlExample = "someUrl/someSubUrl";
        $response = new RedirectResponse($urlExample, 123);
        $this->assertSame(123, $response->getCode());
    }
}
