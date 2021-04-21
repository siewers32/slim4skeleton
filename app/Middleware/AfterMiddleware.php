<?php


namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class AfterMiddleware
{
    public function __invoke(Request $request, RequestHandler $handler) : Response {
        $response = $handler->handle($request);

        $response->getBody()->write('AFTER');
        return $response;
    }
}