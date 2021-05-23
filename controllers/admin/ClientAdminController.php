<?php

class ClientAdminController{
    private $adminClient;
    
    public function __construct(){
        $this-> adminClient = new ClientModel();
        
    }

    public function clientsList(){
        AuthController::isLogged();
        AuthController::accessUser2();
        AuthController::accessUser3();

        if(isset($_GET["id"]) && isset($_GET["status"]) && !empty($_GET["id"])){
            $id_c = $_GET["id"];
            $status = $_GET["status"];

            $client = new Client();
            if($status ==1){
                $status = 0;
            }else{
                $status = 1;
            }
            $client -> setId_client($id_c);
            $client -> setStatus_client($status);

            $this -> adminClient -> updateStatusClient($client);
        }
        $allClients = $this -> adminClient -> getClients();
        require_once("./views/admin/clients/clientsList.php");
    }

    public function addClient(){
        AuthController::isLogged();
        AuthController::accessUser2();
        AuthController::accessUser3();

        if(isset($_POST["soumis"]) && !empty($_POST['name']) && !empty($_POST['login']) && !empty($_POST['pass'])){
            if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && strlen($_POST["pass"]) >= 4){
                $name = trim(strip_tags(addslashes($_POST["name"])));
                $firstname = trim(strip_tags(addslashes($_POST["firstname"])));
                $address = trim(strip_tags(addslashes($_POST["address"])));
                $cp = trim(strip_tags(addslashes($_POST["cp"])));
                $city = trim(strip_tags(addslashes($_POST["city"])));
                $country = trim(strip_tags(addslashes($_POST["country"])));
                $email = trim(strip_tags(addslashes($_POST["email"])));
                $login = trim(strip_tags(addslashes($_POST["login"])));
                $pass = md5(trim(strip_tags(addslashes($_POST["pass"]))));

                $newC = new Client();
                $newC->setName_client($name);
                $newC->setFirstname_client($firstname);
                $newC->setAddress($address);
                $newC->setCp($cp);
                $newC->setCity($city);
                $newC->setCountry($country);
                $newC->setEmail_client($email);
                $newC->setLogin_client($login);
                $newC->setPass_client($pass);
                $newC->setStatus_client(1);                
                
                $ok = $this -> adminClient -> insertClient($newC);
                if($ok){
                    header("location:index.php?action=list_clients");
                } 
            }
        }
        require_once("./views/admin/clients/addClient.php");
    }

    public function editClient(){
        AuthController::isLogged();
        AuthController::accessUser2();
        AuthController::accessUser3();
        
        if(isset($_GET["id"]) && filter_var($_GET["id"], FILTER_VALIDATE_INT)){
            $id = $_GET["id"];
            
            $editC = new Client;
            $editC -> setId_client($id);

            $updateC = $this -> adminClient -> clientItem($editC);

            if(isset($_POST["soumis"]) && !empty($_POST['name'])){
                $name = trim(strip_tags(addslashes($_POST["name"])));
                $firstname = trim(strip_tags(addslashes($_POST["firstname"])));
                $address = trim(strip_tags(addslashes($_POST["address"])));
                $cp = trim(strip_tags(addslashes($_POST["cp"])));
                $city = trim(strip_tags(addslashes($_POST["city"])));
                $country = trim(strip_tags(addslashes($_POST["country"])));
                $email = trim(strip_tags(addslashes($_POST["email"])));
                $login = trim(strip_tags(addslashes($_POST["login"])));
                $pass = md5(trim(strip_tags(addslashes($_POST["pass"]))));

                // $updateC->setId_client($id);
                $updateC->setName_client($name);
                $updateC->setFirstname_client($firstname);
                $updateC->setAddress($address);
                $updateC->setCp($cp);
                $updateC->setCity($city);
                $updateC->setCountry($country);
                $updateC->setEmail_client($email);
                $updateC->setLogin_client($login);
                $updateC->setPass_client($pass);
                $updateC->setStatus_client(1); 
               
                
                $ok = $this->adminClient->updateClient($updateC);
                header("location:index.php?action=list_clients");
            }
            require_once("./views/admin/clients/editClient.php");
        }         
    }
}