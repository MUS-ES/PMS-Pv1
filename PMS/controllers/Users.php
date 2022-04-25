<?php

class Users extends Controller
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = $this->model('User_mod');
    }
    public function index()
    {

        $this->login();
    }
    public function signup()
    {

        $data = [
            'mode' => "sign-up-mode",
            'emailError' => ""
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $name = explode(" ", trim($_POST['fullname']));
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'first_name' => $name[0],
                'last_name' => $name[1],
                'ph_name' => trim($_POST['ph_name']),
                'licence' => trim($_POST['licence']),
                'active' => ACCOUNT_ACTIVE,    //By Default Account Is Not Active
            ];

            // Hash password
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            //Register user from model function
            if ($id = $this->userModel->register($data))
            {
                $user = (object)$data;
                $user->id = $id;

                $this->createUserSession($user);

                //Redirect to the home page
                header('location: ' . URLROOT . '/Home');
            }
            else
            {
                die('Something went wrong.');
            }
        }
        $this->view('index', $data);
    }




    public function login()
    {

        $data = [
            'email' => "",
            'password' => "",
            'loginError' => "",
            'mode' => "login"
        ];

        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'loginError' => ""
            ];
            $user = $this->userModel->login($data['email'], $data['password']);

            if (!$user)
            {
                $data['loginError'] = 'Credentials is not correct';
            }
            else
            {
                $this->createUserSession($user);
                header('location: ' . URLROOT . '/Home');
            }
        }
        $this->view('index', $data);
    }

    public function createUserSession($user)
    {
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $user->id;
        $_SESSION['active'] = $user->active;
        $_SESSION['email'] = $user->email;
    }

    public function signout()
    {
        unset($_SESSION['loggedin']);
        unset($_SESSION['user_id']);
        unset($_SESSION['active']);
        unset($_SESSION['email']);
        header('location:' . URLROOT . 'Users/login');
    }
}
