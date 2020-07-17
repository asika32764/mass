<?php
/**
 * Part of phoenix project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

use Windwalker\Core\Router\RouteCreator;

/** @var RouteCreator $router */

$router->group('sakura')
    // Set menu active name
    ->extra('menu', ['mainmenu' => 'sakuras'])
    ->register(function (RouteCreator $router) {
        // Sakura
        $router->any('sakura', '/sakura(/id)')
            ->controller('Sakura')
            ->extra('layout', 'sakura');

        // Sakuras
        $router->any('sakuras', '/sakuras')
            ->controller('Sakuras')
            ->postAction('CopyController')
            ->putAction('FilterController')
            ->patchAction('BatchController')
            ->extra('layout', 'sakuras');
    });
