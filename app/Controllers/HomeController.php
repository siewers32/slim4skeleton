<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;

class HomeController extends Controller
{

    public function index($request, $response) :ResponseInterface {
        $message = "Hello World";

        return $this->view->render($response, 'auth/signin.html', [
            'message' => $message,
        ]);
    }
}