<?php

require_once '../repository/UserRepository.php';

/**
 * Siehe Dokumentation im DefaultController.
 */

class UserController
{
    public $err = array();
    public $pregex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/";
    public function index()
    {
        $view = new View('user_login');
        $view->title = 'Login';
        $view->heading = 'Login';

        $view->display();
    }
    public function login()
    {
        $view = new View('user_login');
        $view->title = 'Login';
        $view->heading = 'Login';

        $view->display();
    }
    public function doLogin(){
        $userRepository = new UserRepository();
        if(isset($_POST['send'])) {
            if (isset($_POST['email']) && $_POST['password']) {
                $username = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);
                $user = $userRepository->readByName($username);
                if ($user->uname != null) {
                    if (password_verify($password, $user->pw)) {
                        header('Location: /choice');
                    } else {
                        $this->doError('Wrong Password!!');
                        header('Location: /user/login');

                    }
                } else {
                    $this->doError('User does not Exist!!');
                    header('Location: /user/login');
                }
            }
        }
    }
    public function create()
    {
        $view = new View('user_create');
        $view->title = 'Registration';
        $view->heading = 'Registration';
        $view->display();
    }

    public function doCreate()
    {
        if (isset($_POST['signup'])) {
             $username = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $password2 = htmlspecialchars($_POST['password2']);
            if($username == "jericoluislua" || $username == "SVRNM"){
                $isAdmin = true;
            }
            else{
                $isAdmin = false;
            }
            if($password==$password2) {
                if(preg_match($this->pregex, $password)){
                    $userRepository = new UserRepository();

                    if($userRepository->existingUsername($username) == true){
                        $this->doError('Username already exists.');
                        header('Location: /user/create');
                    }
                    if($userRepository->existingUsername($username) == false){
                        $userRepository->create($username, $password, $isAdmin);
                        // goes directly to the login page (HTTP 302)
                        $this->doError("Succesfully registered!");
                        header('Location: /user/login');
                    }
                }
                else{
                    $this->doError('Your password needs to have the following: 1 upper and lowercase, a digit and consists of 8 characters.');
                    header('Location: /user/create');

                }
            }
            if($password != $password2){
                $this->doError("Passwords did not match!");
                header('Location: /user/create');
            }
        }


    }

    public function doError($error){
        $this->err = array_fill(0,1,$error);
        session_start();
        $_SESSION['err'] = $this->err;
    }
    public function delete()
    {
        $userRepository = new UserRepository();
        $userRepository->deleteById($_GET['id']);

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }
}
