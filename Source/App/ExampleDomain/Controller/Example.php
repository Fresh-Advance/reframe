<?php

namespace Frame\App\ExampleDomain\Controller;

use Frame\Runtime\HttpSession\Response;

class Example
{
    public function index(): Response
    {
        return new Response('Example index');
    }
}
