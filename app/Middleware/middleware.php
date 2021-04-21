<?php
use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;
use App\Controllers\Controller;
use Dotenv\Dotenv;
use Psr\Log\LoggerInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

return function (App $app) {

    $c = $app->getContainer();
    $app->addErrorMiddleware( $_ENV["APP_DEBUG"], true, true);

    //TwigMiddleware
    $c->set('view', function () use ($c) {
        $view =  Twig::create(base_path().'/views', ['cache' => false ]);  //['cache' => base_path(). '/cache']
        return $view;
    });
    $app->add(TwigMiddleware::createFromContainer($app));

    //Controllers
    $c->set('Controller', function(ContainerInterface $c) {
        return new Controller($c);
    });

};

