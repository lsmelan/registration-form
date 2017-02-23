<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();
$routes->add(
    'homepage_showForm',
    new Route(
        '/',
        ['_controller' => 'Controller\\Homepage::showForm']
    )
);

$routes->add(
    'ajax_isRegisteredEmail',
    new Route(
        '/ajax/isRegisteredEmail',
        ['_controller' => 'Controller\\Ajax::isRegisteredEmail']
    )
);

return $routes;
