<?php

namespace Frame\Tests\Unit\Runtime\HttpSession;

use Frame\Runtime\HttpSession\Response;
use Frame\Tests\Unit\BaseTestCase;

/**
 * @covers \Frame\Runtime\HttpSession\Response
 */
class ResponseTest extends BaseTestCase
{
    public function testDefaultConstructorArguments(): void
    {
        $response = new Response();
        $this->assertSame('', $response->getContent());
        $this->assertSame(Response::DEFAULT_CODE, $response->getCode());
        $this->assertSame([], $response->getHeaders());
    }

    public function testFullConstructorArguments(): void
    {
        $content = 'some content';
        $response = new Response($content, 500, [
            'header1: value1',
            'header2: value2'
        ]);
        $this->assertSame($content, $response->getContent());
        $this->assertSame(500, $response->getCode());
        $this->assertSame([
            ['header1: value1', true],
            ['header2: value2', true]
        ], $response->getHeaders());
    }

    public function testsSetGetContent(): void
    {
        $content = 'some content';
        $response = new Response();
        $response->setContent($content);
        $this->assertSame($content, $response->getContent());
    }

    public function testsSetGetResponseCode(): void
    {
        $content = 'some content';
        $response = new Response($content);
        $response->setCode(400);
        $this->assertSame(400, $response->getCode());
    }

    public function testsSetGetResponseHeaders(): void
    {
        $response = new Response();
        $response->addHeader("name1: value1");
        $this->assertSame([
            ["name1: value1", true]
        ], $response->getHeaders());
    }

    public function testsAddHeaders(): void
    {
        $response = new Response();
        $response->addHeader("name1: value1");
        $response->addHeader("name2: value2");
        $response->addHeader("name3: value3", false);
        $response->addHeader("name4: value4", true);
        $this->assertSame([
            ["name1: value1", true],
            ["name2: value2", true],
            ["name3: value3", false],
            ["name4: value4", true]
        ], $response->getHeaders());
    }

    public function testChaining(): void
    {
        $response = new Response();
        $response->setCode(123)
            ->setContent("testContent")
            ->addHeader("name1: value1")
            ->addHeader("name2: value2");

        $this->assertSame("testContent", $response->getContent());
        $this->assertSame(123, $response->getCode());
        $this->assertSame([
            ["name1: value1", true],
            ["name2: value2", true]
        ], $response->getHeaders());
    }

    /**
     * @runInSeparateProcess
     */
    public function testSend(): void
    {
        if (!function_exists('xdebug_get_headers')) {
            $this->markTestSkipped("xDebug should be turned on for this method to exist");
        }

        $content = 'some content';
        $headers = [
            'header1: value1',
            'header2: value2',
            'header3: value3',
            'header1: value4',
            ['header2: value5', true],
            ['header3: value6', false]
        ];
        $response = new Response($content, 123, $headers);

        ob_start();
        $response->send();
        $result = ob_get_clean();

        $this->assertSame($content, $result);
        $this->assertSame(123, http_response_code());
        $this->assertSame([
            "header3: value3",
            "header1: value4",
            "header2: value5",
            "header3: value6"
        ], xdebug_get_headers());
    }
}
