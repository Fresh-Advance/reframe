<?php

namespace Frame\Config;

use Frame\App\ExampleDomain\ExampleRoutes;
use FreshAdvance\Dependency\Configuration\Item;
use FreshAdvance\Dependency\Container;
use FreshAdvance\Dependency\Interfaces\ConfigurationItemCollection;

class Dependency implements ConfigurationItemCollection
{
    public function getItems(): array
    {
        return [
            new Item('Request', function () {
                return new \Frame\Runtime\HttpSession\Request(
                    \Frame\Runtime\HttpSession\Request::getGlobals()
                );
            }),
            new Item('Router', function () {
                return new Container(new ExampleRoutes());
            }),
            new Item('Config/Environment', new Environment()),
        ];
    }
}
