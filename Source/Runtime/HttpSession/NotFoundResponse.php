<?php

namespace Frame\Runtime\HttpSession;

class NotFoundResponse extends Response
{
    public const CODE_NOT_FOUND = 404;

    public const DEFAULT_MESSAGE = "Not found";

    /**
     * Not Found Response constructor.
     *
     * @param string $message
     */
    public function __construct(string $message = null)
    {
        $message = $message ? $message : self::DEFAULT_MESSAGE;

        parent::__construct($message, self::CODE_NOT_FOUND);
    }
}
