<?php

namespace Frame\Runtime\HttpSession;

class ForbiddenResponse extends Response
{
    public const CODE_FORBIDDEN = 403;

    public const DEFAULT_MESSAGE = 'Forbidden';

    /**
     * Forbidden Response constructor.
     *
     * @param string $message
     */
    public function __construct(string $message = self::DEFAULT_MESSAGE)
    {
        parent::__construct($message, self::CODE_FORBIDDEN);
    }
}
