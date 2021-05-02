<?php

namespace Frame\Runtime\HttpSession;

use Sieg\SeparatorAccess\DataContainer;

class Request extends DataContainer
{
    public const PARAM_GET = 'get';
    public const PARAM_POST = 'post';
    public const PARAM_COOKIE = 'cookie';
    public const PARAM_FILES = 'files';
    public const PARAM_SERVER = 'server';

    /**
     * Request constructor.
     *
     * @param array<mixed> $initialData
     */
    public function __construct(array $initialData = [])
    {
        parent::__construct($initialData);
    }

    /**
     * @return array<array>
     */
    public static function getGlobals(): array
    {
        return [
            self::PARAM_GET => &$_GET,
            self::PARAM_POST => &$_POST,
            self::PARAM_COOKIE => &$_COOKIE,
            self::PARAM_FILES => &$_FILES,
            self::PARAM_SERVER => &$_SERVER
        ];
    }

    /**
     * @return string|null
     */
    public function getReferer()
    {
        return $this->get(self::PARAM_SERVER . ".HTTP_REFERER");
    }

    /**
     * @return string|null
     */
    public function getUri()
    {
        return $this->get(self::PARAM_SERVER . ".REQUEST_URI");
    }
}
