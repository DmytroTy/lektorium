<?php

use App\Controller\HomeWorkController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->add('app_php', '/php')
        ->controller([HomeWorkController::class, 'php']);
};
