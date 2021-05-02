<?php

namespace Frame\Runtime\Controller;

use Frame\Affection\DependencyAware;
use Frame\Runtime\HttpSession\Response;
use Psr\Container\ContainerInterface;

/**
 * Controller Action Caller Class
 *
 * @package Frame\Processor
 */
class ActionDispatcher
{
    use DependencyAware;

    public function __construct(ContainerInterface $di)
    {
        $this->setDependency($di);
    }

    /**
     * Process the action and get the Response
     *
     * @param Action $action
     *
     * @return Response
     * @throws \Exception
     */
    public function dispatch(Action $action): Response
    {
        $di = $this->getDependencyContainer();
        $controllerClass = $action->getController();

        $controller = new $controllerClass($di);
        $actionName = $action->getAction();

//        if (!$controller->checkAccess($actionName)) {
//            return new ForbiddenResponse('No rights to access' . $action->getTitle());
//        }

//        $controller->beforeAction();

        $parameters = $action->getParams();
        array_unshift($parameters, $di);

        $callback = [$controller, $actionName];
        if (is_callable($callback)) {
            $response = call_user_func($callback, ...$parameters);
        } else {
            throw new \Exception($action->getTitle() . ' is not callable');
        }

//        $controller->afterAction();

        return $response;
    }
}
