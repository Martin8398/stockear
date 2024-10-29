<?php

require_once 'app/models/userModel.php';

class AuthController
{
    private $model;
    private $view;

    function __construct()
    {
        $this->model = new userModel();
        $this->view = new authView();
    }

    public function login($req, $res)
    {
        if (!isset($req->body->user) || empty($req->body->user)) {
            return $this->view->error('This input cannot be empty');
        }
        if (!isset($req->body->password) || empty($req->body->password)) {
            return $this->view->error('This input cannot be empty');
        }

        $user = htmlspecialchars($req->body->user);
        $password = htmlspecialchars($req->body->password);


        // Verifies user is in database
        $userFromDB = $this->model->getUserName($user);

        if ($userFromDB && password_verify($password, $userFromDB->password)) {
            // Saves session ID fron user
            session_start();
            session_regenerate_id(true); // Session Id is regenerated to avoid DoS
            $_SESSION['ID_USER'] = $userFromDB->id;
            $_SESSION['USERNAME'] = $userFromDB->user;
            $_SESSION['LAST_ACTIVITY'] = time();

            // Redirijo al home
            header('Location: ' . BASE_URL);
        } else {
            return $this->view->error('Invalid Credentials');
        }
    }
 
    public function logout($req, $res)
    {
        session_start();
        session_unset();
        session_destroy();
        header('location: ' . BASE_URL);
    }
}
