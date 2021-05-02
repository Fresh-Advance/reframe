<?php

namespace Frame\Runtime\HttpSession;

class RedirectResponse extends Response
{
    public const CODE_PERMANENT = 301;
    public const CODE_FOUND = 302;
    public const CODE_SEE_OTHER = 303;
    public const CODE_TEMPORARY = 307;

    /**
     * Redirect Response constructor.
     *
     * @param string $url
     * @param null|int $responseCode
     */
    public function __construct($url, $responseCode = self::CODE_FOUND)
    {
        $headers = [
            "Location: {$url}"
        ];
        parent::__construct(null, $responseCode, $headers);
    }
}
