<?php

namespace App\Controllers;

class HomeController extends Controller
{

    public function index($request,  $response) {
        $message = "Hello World";
        return $this->view->render($response, 'auth/signin.html', [
            'data' => [$message]
        ]);
    }

    public function user($request,  $response, $id) {
            return $this->view->render($response, 'auth/signin.html', [
                'data' => $this->user->find($id)
            ]);

    }
}