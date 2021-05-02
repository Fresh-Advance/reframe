<?php

namespace Frame\Runtime\Controller;

/**
 * Simple container with action description
 */
class Action
{
    public const DEFAULT_ACTION = 'index';

    protected string $controller;

    protected string $action = self::DEFAULT_ACTION;

    /** @var array<mixed> */
    protected $params = [];

    /**
     * Action constructor.
     *
     * @param string $controller
     * @param ?string $action
     * @param ?array<mixed> $params
     */
    public function __construct(string $controller, string $action = null, $params = null)
    {
        $this->setController($controller);

        if ($action) {
            $this->setAction($action);
        }

        if ($params) {
            $this->setParams($params);
        }
    }

    /**
     * @param string $controller
     *
     * @return self
     */
    public function setController(string $controller): self
    {
        $this->controller = $controller;

        return $this;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @param string $action
     *
     * @return self
     */
    public function setAction(string $action): self
    {
        $this->action = $action;

        return $this;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param array<mixed> $params
     *
     * @return $this
     */
    public function setParams(array $params): self
    {
        $this->params = $params;

        return $this;
    }

    /**
     * @return array<mixed>
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * Get formatted name of this action
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->getController() . ':' . $this->getAction();
    }
}
