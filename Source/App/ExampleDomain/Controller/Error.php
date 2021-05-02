<?php

namespace Frame\App\ExampleDomain\Controller;

use Frame\Runtime\HttpSession\NotFoundResponse;
use Frame\Runtime\HttpSession\Response;

class Error
{
    public function notFound(): Response
    {
        return new NotFoundResponse();
    }
}
