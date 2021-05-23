<?php

class ClientPublicController{
    private $adminClient;
    
    public function __construct(){
        $this-> adminClient = new ClientModel();
        
    }

    public function signUpClient(){
        if(isset($_POST["soumis"]) && !empty($_POST['name']) && !empty($_POST['login']) && !empty($_POST['email']) == !empty($_POST['email2']) && !empty($_POST['pass']) == !empty($_POST['pass2'])){
            if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && strlen($_POST['login']) >=20 && strlen($_POST["pass"]) >= 4){
                $name = trim(strip_tags(addslashes($_POST["name"])));
                $firstname = trim(strip_tags(addslashes($_POST["firstname"])));
                $address = trim(strip_tags(addslashes($_POST["address"])));
                $cp = trim(strip_tags(addslashes($_POST["cp"])));
                $city = trim(strip_tags(addslashes($_POST["city"])));
                $country = trim(strip_tags(addslashes($_POST["country"])));
                $email = trim(strip_tags(addslashes($_POST["email"])));
                $email2 = trim(strip_tags(addslashes($_POST["email2"])));
                $login = trim(strip_tags(addslashes(strlen($_POST["login"]))));
                $pass = sha1(trim(strip_tags(addslashes($_POST["pass"]))));
                $pass2 = sha1(trim(strip_tags(addslashes($_POST["pass2"]))));

                $newC = new Client();
                $newC->setName_client($name);
                $newC->setFirstname_client($firstname);
                $newC->setAddress($address);
                $newC->setCp($cp);
                $newC->setCity($city);
                $newC->setCountry($country);
                $newC->setEmail_client($email);
                $newC->setEmail_client($email2);
                $newC->setLogin_client($login);
                $newC->setPass_client($pass);
                $newC->setPass_client($pass2);
                $newC->setStatus_client(1);                
                
                $ok = $this -> adminClient -> insertClient($newC);
                if($ok){
                    header("location:index.php?action=shop");
                }
            }
        }
        require_once("./views/public/clients/inscription.php");
    }

    public function loginClient(){
        if(isset($_POST["soumis"])){
            if (strlen($_POST["pass"]) >= 4 && !empty($_POST["loginEmail"])){
                $loginEmail = trim(strip_tags(addslashes($_POST["loginEmail"])));
                $pass = md5(trim(strip_tags(addslashes($_POST["pass"]))));

                $data_c = $this -> adminClient -> signInClient($loginEmail, $pass);
                if(!empty($data_c)){
                    if($data_c -> status_client > 0){
                        session_start();
                        $_SESSION["AuthClient"] = $data_c; 
                        header("location:index.php?action=shop");
                    }else{
                        $error = "Votre profile est momentanéments désactivé suite aux problèmes rencontrés";
                    }
                }else{
                    $error = "Votre login/email et/ou mot de passe ne correspondent pas";
                }
            }else{
                $error = "Veuillez entrer au moins 4 caractères";
            }
        }
        require_once("./views/public/clients/loginClient.php");
    }

    public function profileClient(){
        AuthController::isLoggedClient();

        $id = $_SESSION['AuthClient'] -> id_client;

        $editP = new Client();
            
        $editP -> setId_client($id);
            
        $editProfile = $this -> adminClient->clientItem($editP);
            
        $valid ="";

        if(isset($_POST["soumis"]) && !empty($_POST['login']) && !empty($_POST['login'])){
            $name = trim(strip_tags(addslashes($_POST["name"])));
            $firstname = trim(strip_tags(addslashes($_POST["firstname"])));
            $address = trim(strip_tags(addslashes($_POST["address"])));
            $cp = trim(strip_tags(addslashes($_POST["cp"])));
            $city = trim(strip_tags(addslashes($_POST["city"])));
            $country = trim(strip_tags(addslashes($_POST["country"])));
            $email = trim(strip_tags(addslashes($_POST["email"])));
            $email2 = trim(strip_tags(addslashes($_POST["email2"])));
            $login = trim(strip_tags(addslashes($_POST["login"])));
            $pass = md5(trim(strip_tags(addslashes($_POST["pass"]))));
            $pass2 = md5(trim(strip_tags(addslashes($_POST["pass2"]))));

            $editProfile->setId_client($id);
            $editProfile->setName_client($name);
            $editProfile->setFirstname_client($firstname);
            $editProfile->setAddress($address);
            $editProfile->setCp($cp);
            $editProfile->setCity($city);
            $editProfile->setCountry($country);
            $editProfile->setEmail_client($email);
            $editProfile->setEmail_client($email2);
            $editProfile->setLogin_client($login);
            $editProfile->setPass_client($pass);
            $editProfile->setPass_client($pass2);
            $editProfile->setStatus_client(1);                
                
            $ok = $this -> adminClient -> updateClient($editProfile);

            // Condition à vérifier car message ne s'affiche pas
            header("location:index.php?action=profile_client"); 
            if($ok = $valid){
                echo "Votre profile a bien été modifié";
                
            }else{
                echo "Votre profile n'a pas été modifié";
            }
        }
        require_once("./views/public/clients/profileClient.php");
    }
}