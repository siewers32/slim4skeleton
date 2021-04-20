<?php

// http routes


use App\Controllers\HomeController;
use App\Controllers\TestController;

$app->get('/home', HomeController::class . ':index')->setName('home');
$app->get('/test', TestController::class . ':test')->setName('test');


