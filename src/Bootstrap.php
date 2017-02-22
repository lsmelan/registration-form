<?php

require __DIR__ . '/../vendor/autoload.php';

use \Whoops\Run;
use \Whoops\Handler\PrettyPageHandler;
use \Symfony\Component\Routing\Matcher\UrlMatcher;
use \Symfony\Component\Routing\RequestContext;
use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use \View\TwigRenderer;

$environment = 'dev';
$whoops = new Run;

if ($environment !== 'prod') {
    $whoops->pushHandler(new PrettyPageHandler);
} else {
    $whoops->pushHandler(function($e){
        //todo: friendly error
    });
}

$whoops->register();

$request = Request::createFromGlobals();
$renderer = new TwigRenderer();

$routes = include 'Routes.php';
$context = new RequestContext();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

$parameters = $matcher->match($request->getPathInfo());
$controller = explode('::', $parameters['_controller']);

$class = new $controller[0]($request, $renderer);
$response = $class->{$controller[1]}();

if ($response instanceof Response) {
    $response->prepare($request);
    $response->send();
}
