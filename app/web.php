<?php

// http routes
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\TestController;
use App\Middleware\AfterMiddleware;
use App\Middleware\BeforeMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/home', [ HomeController::class, 'index' ])->add(new AfterMiddleware())->add(new BeforeMiddleware());
$app->get('/user/{id}', [ HomeController::class, 'user' ]);
$app->get('/test', [ TestController::class , 'test' ]);
$app->post('/auth', [ AuthController::class , 'authenticate' ]);
$app->get('/a', function ($request, $response) {
    print_r($_ENV);
    return $response;
});


$app->get('/hello/{name}', function ($name, ResponseInterface $response) {
    $response->getBody()->write('Hello ' . $name);
    return $response;
});