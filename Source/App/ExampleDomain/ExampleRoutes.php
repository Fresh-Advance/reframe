<?php

namespace Frame\App\ExampleDomain;

use Frame\Runtime\Controller\Action;
use FreshAdvance\Dependency\Configuration\Item;
use FreshAdvance\Dependency\Configuration\Pattern;
use FreshAdvance\Dependency\Interfaces\ConfigurationItemCollection;

class ExampleRoutes implements ConfigurationItemCollection
{
    public function getItems(): array
    {
        return [
            new Item(
                '/',
                fn() => new Action(\Frame\App\ExampleDomain\Controller\Example::class),
                'index'
            ),
            new Pattern(
                'notFound',
                '/.*/',
                fn() => new Action(
                    \Frame\App\ExampleDomain\Controller\Error::class,
                    'notFound'
                ),
            )
        ];
    }
}
