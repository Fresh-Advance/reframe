<?php

namespace Frame\Tests\Unit\Runtime\HttpSession;

use Frame\Runtime\HttpSession\Request;
use Frame\Tests\Unit\BaseTestCase;

/**
 * @covers \Frame\Runtime\HttpSession\Request
 */
class RequestTest extends BaseTestCase
{
    public function testInitialization(): void
    {
        $request = new Request();
        $this->assertInstanceOf(Request::class, $request);
    }

    public function testConstructorDefault(): void
    {
        $request = new Request();
        $this->assertEquals([], $request->getData());
    }

    public function testGetGlobals(): void
    {
        $_GET['key1'] = 'value1';
        $_POST['key2'] = 'value2';
        $_COOKIE['key3'] = 'value3';
        $_FILES['key4'] = 'value4';

        $globals = Request::getGlobals();

        $_GET['key1'] = 'value11';
        $_POST['key2'] = 'value22';
        $_COOKIE['key3'] = 'value33';
        $_FILES['key4'] = 'value44';

        $this->assertEquals([
            Request::PARAM_GET => $_GET,
            Request::PARAM_POST => $_POST,
            Request::PARAM_COOKIE => $_COOKIE,
            Request::PARAM_FILES => $_FILES,
            Request::PARAM_SERVER => $_SERVER
        ], $globals);
    }

    public function testConstructorArgument(): void
    {
        $requestData = [
            Request::PARAM_GET => ['key1' => 'value1'],
            Request::PARAM_POST => ['key2' => 'value2'],
            Request::PARAM_COOKIE => ['key3' => 'value3'],
            Request::PARAM_FILES => ['key4' => 'value4'],
            Request::PARAM_SERVER => ['key5' => 'value5']
        ];
        $request = new Request($requestData);
        $this->assertEquals($requestData, $request->getData());
    }

    public function testGetReferrer(): void
    {
        $requestData = [
            Request::PARAM_SERVER => ['HTTP_REFERER' => 'someValue']
        ];
        $request = new Request($requestData);
        $this->assertEquals('someValue', $request->getReferer());

        $request = new Request();
        $this->assertEquals(null, $request->getReferer());
    }

    public function testGetUri(): void
    {
        $requestData = [
            Request::PARAM_SERVER => ['REQUEST_URI' => 'someUri']
        ];
        $request = new Request($requestData);
        $this->assertEquals('someUri', $request->getUri());

        $request = new Request();
        $this->assertEquals(null, $request->getUri());
    }
}
