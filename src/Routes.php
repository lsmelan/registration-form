<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();
$routes->add(
    'homepage_showForm',
    new Route(
        '/',
        ['_controller' => 'Controllers\\Homepage::showForm']
    )
);

return $routes;
