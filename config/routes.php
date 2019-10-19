<?php

use App\Controller\HomeWorkController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->add('app_php', '/php/{param}')
        ->controller([HomeWorkController::class, 'php'])
        ->defaults(['param' => 'Parameter?']);
};
