<?php

namespace App\Controllers;

use App\Http\Services\Authentication;
use App\Http\Services\Users;
use App\Utils\Validator;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class UserController
{
    protected $templating;

    public function __construct()
    {
        $loader = new FilesystemLoader('templates');
        $this->templating = new Environment($loader, []);        
    }

    public function home()
    {
        echo $this->templating->render('home.html', []);
    }

    public function users()
    {
        $userService = new Users();
        $users = $userService->listAll();

        echo $this->templating->render('users.html', [ 'users' => $users ]);
    }

    public function register()
    {
        $request = input()->all();
        
        $validator = new Validator($request);

        $violations = $validator->validate(
            [
                'name' => [ 'required', 'min:3', 'max:50' ],
                'email' => [ 'required', 'email' ],
                'password' => [ 'required', 'min:6', 'max:20' ]
            ]
        );

        if ($violations) {
            $messages = [];

            foreach ($violations as $violation) {
                foreach ($violation as $message) {
                    $messages[] = $message;
                }
            }

            session_start();

            $_SESSION['violations'] = $messages;
            redirect('/register');
        }

        $request['password'] = md5($request['password']);

        $userService = new Users();
        $userService->create($request);
        
        $authentication = new Authentication();
        $authentication->authenticate($request);

        redirect('/home');
    }
}
