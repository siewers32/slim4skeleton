<?php
use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;
use App\Controllers\Controller;



return function (App $app) {

    //ErrorMiddleware
    $c = $app->getContainer();
    $app->addErrorMiddleware( true, true, true);

    //TwigMiddleware
    $c->set('view', function () use ($c) {
        $view =  Twig::create(__DIR__ . '/../views', ['cache' => false]);  //['cache' => __DIR__ . '/../cache']
        return $view;
    });
    $app->add(TwigMiddleware::createFromContainer($app));

    //Controllers
    $c->set('Controller', function(ContainerInterface $c) {
        return new Controller($c);
    });
};

