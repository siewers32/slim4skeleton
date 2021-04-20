<?php


namespace App\Controllers;
use Psr\Http\Message\ResponseInterface;

class TestController extends Controller
{
    public function test ($request, $response) :ResponseInterface {
            $message = "Hello World from test";

            return $this->view->render($response, 'auth/signin.html', [
                'message' => $message,
            ]);
    }
}