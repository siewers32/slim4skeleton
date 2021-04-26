<?php


namespace App\Controllers;
use Cake\Validation\Validator;

class AuthController extends Controller
{
        public function index($request,  $response) {
        $message = "Hello from authcontroller";
        return $this->view->render($response, 'auth/signin.html', [
            'data' => [$message]
        ]);
    }

    public function user($request,  $response, $id) {
        return $this->view->render($response, 'auth/signin.html', [
            'data' => $this->user->find($id)
        ]);

    }

    public function authenticate($request, $response) {
        $data = (array)$request->getParsedBody();
        $errors = $this->validateUserForm($data);
        if (empty($errors)) $errors = $this->procesCredentials($data);

        if (empty($errors)) {
            return $this->view->render($response,'auth/authenticated.html');
        } else {
            return $this->view->render($response, 'auth/signin.html', [
                'errors' => $errors,
                'data' => $data
            ]);
        }


  }

    public function validateUserForm(array $data) {
        $validator = new Validator();

        $validator
            ->requirePresence('login')->notEmptyString('login', 'Graag je achternaam invullen')
            ->requirePresence('password')->notEmptyString('password', 'Graag je voornaam invullen');


        var_dump($data);
        return $validator->validate($data);

    }

    public function procesCredentials($data) {
            var_dump('in procesCredentials', $data['login'] , $data['password']);
            return $data['login'] == 'piet' && $data['password'] == 'truus' ? [] : ['auth' => ['Authentication error']];
    }
}