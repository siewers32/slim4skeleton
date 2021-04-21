<?php

// http routes
use App\Controllers\HomeController;
use App\Controllers\TestController;
use App\Middleware\AfterMiddleware;
use App\Middleware\BeforeMiddleware;


$app->get('/home', [ HomeController::class, 'index' ])->add(new AfterMiddleware())->add(new BeforeMiddleware());
$app->get('/test', [ TestController::class , 'test' ]);
$app->get('/a', function ($request, $response) {
    print_r($_ENV);
    return $response;
});


