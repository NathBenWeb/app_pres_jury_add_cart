<?php

class UserController{
    private $adminUser;
    private $adminGrade;

    public function __construct(){
        $this-> adminUser = new UserModel();
        $this-> adminGrade = new GradeModel();
    }

    public function loginAdmin(){
        if(isset($_POST["soumis"])){
            if(strlen($_POST["pass"]) >= 4 && !empty($_POST["loginEmail"])){
                $loginEmail = trim(strip_tags(addslashes($_POST["loginEmail"])));
                $pass = md5(trim(strip_tags(addslashes($_POST["pass"]))));
                $data_u = $this -> adminUser -> signIn($loginEmail, $pass);
                
                if(!empty($data_u)){
                    if($data_u -> status > 0){
                        session_start();

                        $_SESSION["Auth"] = $data_u;
                        header("location:index.php?action=list_meals");
                    }else{
                        $error = "Votre compte n'existe plus";
                    }
                }else{
                    $error = "Votre login/email et/ou mot de passe ne correspondent pas";
                }
            }else{
                $error = "Veuillez entrer au moins 4 caractères";
            }
        }
        require_once("./views/admin/users/loginUser.php");
        
    }

    public function usersList(){
        AuthController::isLogged();
        AuthController::accessUser2();
        AuthController::accessUser3();
        
        if(isset($_GET["id"]) && isset($_GET["status"]) && !empty($_GET["id"])){
            $id_u = $_GET["id"];
            $status = $_GET["status"];

            $user = new User();
            if($status ==1){
                $status = 0;
            }else{
                $status = 1;
            }
            $user -> setId_user($id_u);
            $user -> setStatus($status);

            $this -> adminUser -> updateStatus($user);
        }
        $allUsers = $this -> adminUser -> getUsers();
        require_once("./views/admin/users/usersList.php");
    }

    public function addUser(){
        AuthController::isLogged();
        AuthController::accessUser2();
        AuthController::accessUser3();

        if(isset($_POST["soumis"])){
            if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && strlen($_POST["pass"]) >= 4){
                $name = trim(strip_tags(addslashes($_POST["name"])));
                $firstname = trim(strip_tags(addslashes($_POST["firstname"])));
                $email = trim(strip_tags(addslashes($_POST["email"])));
                $pass = md5(trim(strip_tags(addslashes($_POST["pass"]))));
                $login = trim(strip_tags(addslashes($_POST["login"])));
                $id_g = trim(strip_tags(addslashes($_POST["grade"])));

                $newU = new User();
                $newU->setFirstname($firstname);
                $newU->setName($name);
                $newU->setLogin($login);
                $newU->setPass($pass);
                $newU->setEmail($email);
                $newU->setStatus(1);                
                $newU->getGrade()->setId_g($id_g);
                
                $ok = $this -> adminUser -> insertUser($newU);
                
                if($ok){
                    header("location:index.php?action=list_users");
                } 
            }
        }
        $tabGrade = $this -> adminGrade -> getGrades();

        require_once("./views/admin/users/addUser.php");
    }

    public function editUser(){
        AuthController::isLogged();
        AuthController::accessUser2();
        AuthController::accessUser3();
        
        if(isset($_GET["id"]) && filter_var($_GET["id"], FILTER_VALIDATE_INT)){
            $id = $_GET["id"];
            $editU = new User;
            $editU -> setId_user($id);

            $user = $this -> adminUser -> userItem($editU);

            $tabGrade = $this -> adminGrade  -> getGrades();
            
            if(isset($_POST["soumis"]) && !empty($_POST["name"])){
                $firstname = addslashes(strip_tags(trim($_POST["firstname"])));
                $name = addslashes(strip_tags(trim($_POST["name"])));
                $login = addslashes(strip_tags(trim($_POST["login"])));
                $pass = md5(addslashes(strip_tags(trim($_POST["pass"]))));
                $email = addslashes(strip_tags(trim($_POST["email"])));
                $id_g = addslashes(strip_tags(trim($_POST["grade"])));

                $user->setFirstname($firstname);
                $user->setName($name);
                $user->setLogin($login);
                $user->setPass($pass);
                $user->setEmail($email);
                $user->setStatus(1);
                $user->getGrade()->setId_g($id_g);
                
                $this->adminUser->updateUser($user);
                
                header("location:index.php?action=list_users");
            }
            require_once("./views/admin/users/editUser.php");
        }         
    }
}