<?php

namespace App\Controllers;

use App\Http\Response;
use App\Http\Services\Authentication;
use App\Http\Services\Users;
use App\Utils\Validator;

class UserController extends MainController
{
    protected $loggedAs;

    public function __construct()
    {
        parent::__construct();
        session_start();

        if (isset($_SESSION['user'])) {
            $this->loggedAs = $_SESSION['user']['name'];
        }
    }

    public function index()
    {
        echo $this->templating->render('index.html', []);
    }

    public function login()
    {
        session_start();

        $msg = '';
        if ($_SESSION['error_msg']) {
            $msg = $_SESSION['error_msg'];
            unset($_SESSION['error_msg']);
        }

        echo $this->templating->render('login.html', [ 'error_msg' => $msg ]);
    }
    
    public function register()
    {
        session_start();

        $violations = '';
        if ($_SESSION['violations']) {
            $violations = $_SESSION['violations'];
            unset($_SESSION['violations']);
        }

        echo $this->templating->render('register.html', [ 'violations' => $violations ]);
    }

    public function home()
    {
        echo $this->templating->render('home.html', [ 'loggedAs' => $this->loggedAs ]);
    }

    public function users()
    {
        $userService = new Users();
        $users = $userService->findAll();

        echo $this->templating->render('users.html', [ 'users' => $users, 'loggedAs' => $this->loggedAs ]);
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
        $user = $authentication->authenticate($request);

        session_start();
        $_SESSION['user'] = $user;

        redirect('/home');
    }

    public function viewUser($id)
    {
        $userService = new Users();
        $user = $userService->findOne([ 'id' => $id ]);

        echo $this->templating->render('user.html', [ 'user' => $user, 'loggedAs' => $this->loggedAs ]);
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
