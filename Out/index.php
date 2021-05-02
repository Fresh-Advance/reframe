<?php

namespace Frame\Out;

use Frame\Config\Dependency;
use Frame\Runtime\Controller\ActionDispatcher;
use FreshAdvance\Dependency\Container;

require_once '../vendor/autoload.php';

$diContainer = new Container(new Dependency());
$router = $diContainer->get('Router');

/** @var \Frame\Runtime\HttpSession\Request $request */
$request = $diContainer->get('Request');

$action = $router->get($request->getUri());
$ad = new ActionDispatcher($diContainer);

$response = $ad->dispatch($action);
$response->send();

/** @var \Frame\Config\Environment $environmentConfig */
$environmentConfig = $diContainer->get('Config/Environment');
if ($environmentConfig->isDebugMode()) {
    echo '<div style="position:fixed; bottom:0; right:0;">'
        . round(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 3) * 1000
        . ' ms.</div>';
}