<?php

use DI\ContainerBuilder;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Dotenv\Dotenv;
use Psr\Log\LoggerInterface;
use DI\Bridge\Slim\Bridge;
use Slim\Handlers\Strategies\RequestHandlerInterface as RequestHandler;

//Dotenv
try {
    $env = Dotenv::createImmutable(base_path());
    $env->load();
} catch (\Dotenv\Exception\InvalidPathException) { }

$app = Bridge::create();
$c = $app->getContainer();

//Settings not used yet
//$settings = require(base_path().'/app/settings.php');
//$c->set('settings', $settings);

//ErrorMiddleware
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

//TwigMiddleware
$c = $app->getContainer();
$c->set('view', function () use ($c) {
    $view = Twig::create(__DIR__ . '/../views', ['cache' => false]);  //['cache' => __DIR__ . '/../cache']
    return $view;
});
$app->add(TwigMiddleware::createFromContainer($app));

//Routes
$routes = require __DIR__ . '/../app/web.php';

$app->run();