<?php

namespace App\Controllers;

use App\Http\Response;
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
        $users = $userService->findAll();

        echo $this->templating->render('users.html', [ 'users' => $users ]);
    }

    public function createUser()
    {
        $request = input()->all();
        
        $validator = new Validator($request);

        $violations = $validator->validate(
            [
                'name' => [ 'required', 'min:5', 'max:50' ],
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

    public function viewUser($id)
    {
        $userService = new Users();
        $user = $userService->findOne([ 'id' => $id ]);

        echo $this->templating->render('user.html', [ 'user' => $user ]);
    }

    public function updateUser()
    {
        $request = input()->all();
        
        $validator = new Validator($request);

        $violations = $validator->validate(
            [
                'name' => [ 'required', 'min:5', 'max:50' ],
                'email' => [ 'required', 'email' ]
            ]
        );

        if ($violations) {
            $messages = [];

            foreach ($violations as $violation) {
                foreach ($violation as $message) {
                    $messages[] = $message;
                }
            }
        }

        $userService = new Users();
        $userService->update($request);

        redirect('/user/' . $request['id']);
    }

    public function deleteUser()
    {
        $request = input()->all();

        $userService = new Users();
        $userService->delete($request['id']);

        new Response([
            'success' => true,
            'payload' => [
                'message' => "USER_DELETED",
                'data' => []
            ]
        ]);
    }
}
