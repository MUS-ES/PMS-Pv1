<?php

class Admin extends Controller
{
    private $adminModel;
    public function __construct()
    {
        $this->adminModel = $this->model('Admin_mod');
    }
    public function index()
    {
        $this->login();
    }
    public function login()
    {

        $data = [
            'loginError' => "",
        ];

        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'loginError' => ""
            ];
            $user = $this->adminModel->login($data['username'], $data['password']);

            if (!$user) {
                $data['loginError'] = 'Credentials is not correct';
            } else {
                $this->createAdminSession($user);
                header('location: ' . URLROOT . 'Panel/');
            }
        }
        $this->view('admin', $data);
    }

    public function createAdminSession($user)
    {
        $_SESSION['adminloggedin'] = true;
        $_SESSION['adminusername'] = $user->username;
    }
    public function logout()
    {
        unset($_SESSION['adminloggedin']);
        unset($_SESSION['adminusername']);
        header('location:' . URLROOT . 'users/login/');
    }
}
