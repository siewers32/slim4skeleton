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
use Tuupola\Middleware\JwtAuthentication;
use App\Models\User;

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
$errorMiddleware = $app->addErrorMiddleware($_ENV['APP_DEBUG'], true, true);

//JWT
$app->add(new JwtAuthentication([
    "path" => "/api",
    "secret" => $_ENV["JWT_SECRET"]
]));

//Database
$c->set('db', function () {
    $pdo =  new PDO("mysql:host=".$_ENV['DB_HOST'].";dbname=".$_ENV['DB_NAME'],$_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
});

//TwigMiddleware
$c->set('view', function () use ($c) {
    $view = Twig::create(__DIR__ . '/../views', ['cache' => false]);  //['cache' => __DIR__ . '/../cache']
    return $view;
});
$app->add(TwigMiddleware::createFromContainer($app));

$c->set('user', function () use ($c) {
   return new User($c);
});

//Routes
$routes = require __DIR__ . '/../app/web.php';

$app->run();