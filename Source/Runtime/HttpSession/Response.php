<?php

namespace Frame\Runtime\HttpSession;

class Response
{
    public const DEFAULT_CODE = 200;

    /**
     * The response body
     *
     * @var string
     */
    protected $content = '';

    /**
     * The response code
     *
     * @var int
     */
    protected $code = self::DEFAULT_CODE;

    /**
     * Headers list
     *
     * @var array<mixed>
     */
    protected $headers = [];

    /**
     * Response constructor.
     *
     * @param null|string $responseContent
     * @param null|int $responseCode
     * @param array<mixed> $responseHeaders
     */
    public function __construct($responseContent = null, $responseCode = null, $responseHeaders = [])
    {
        if ($responseContent !== null) {
            $this->setContent($responseContent);
        }

        if ($responseCode !== null) {
            $this->setCode($responseCode);
        }

        if ($responseHeaders && is_array($responseHeaders)) {
            $this->addHeaders($responseHeaders);
        }
    }

    /**
     * Set content for response
     *
     * @param string $content
     *
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get response content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set response code
     *
     * @param int $code
     *
     * @return self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get response code
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Add new header for sending with response
     *
     * @param string $headerLine
     * @param bool $replace
     *
     * @return self
     */
    public function addHeader($headerLine, $replace = true)
    {
        $this->headers[] = [$headerLine, $replace];

        return $this;
    }

    /**
     * Add list of headers
     *
     * @param array<mixed> $headers
     */
    public function addHeaders(array $headers): void
    {
        foreach ($headers as $headerConfiguration) {
            if (is_array($headerConfiguration)) {
                $this->addHeader($headerConfiguration[0], $headerConfiguration[1]);
            } else {
                $this->addHeader($headerConfiguration);
            }
        }
    }

    /**
     * Get all currently set response headers array
     *
     * @return array<mixed> ['name'=>'value']
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Process the response
     */
    public function send(): void
    {
        $this->sendResponseCode();
        $this->sendHeaders();
        $this->sendContent();
    }

    /**
     * Send contents of response to output
     */
    protected function sendContent(): void
    {
        echo $this->getContent();
    }

    /**
     * Set the response code to output
     */
    protected function sendResponseCode(): void
    {
        http_response_code($this->getCode());
    }

    /**
     * Set headers to response
     */
    protected function sendHeaders(): void
    {
        foreach ($this->getHeaders() as $headerConfig) {
            header($headerConfig[0], $headerConfig[1]);
        }
    }
}
