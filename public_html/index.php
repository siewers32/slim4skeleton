<?php
use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require __DIR__ . '/../vendor/autoload.php';

$container = new Container;

AppFactory::setContainer($container);
$app = AppFactory::create();


//ErrorMiddleware
$app->addErrorMiddleware( true, true, true);

//TwigMiddleware
$c = $app->getContainer();
$c->set('view', function () use ($c) {
    $view =  Twig::create(__DIR__ . '/../views', ['cache' => false]);  //['cache' => __DIR__ . '/../cache']
    return $view;
});

$app->add(TwigMiddleware::createFromContainer($app));

//Controllers
$c->set('HomeController', function(ContainerInterface $c) {
    $view = $container->get('view');
    return new HomeController($view);
});

$routes = require __DIR__ . '/../app/web.php';

$app->run();