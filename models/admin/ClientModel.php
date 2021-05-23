<?php

class ClientModel extends Driver{
    public function getClients(){
        $sql ="SELECT * FROM clients ORDER BY id_client DESC" ;

        $result = $this->getRequest($sql);

        $rows = $result->fetchAll(PDO::FETCH_OBJ);
        $tabClient = [];

        foreach($rows as $row){
            $client = new Client();
            $client->setId_client($row->id_client);
            $client->setName_client($row->name_client);
            $client->setFirstname_client($row->firstname_client);
            $client->setaddress($row->address);
            $client->setCp($row->cp);
            $client->setCity($row->city);
            $client->setCountry($row->country);
            $client->setEmail_client($row->email_client);
            $client->setInscription($row->inscription);
            $client->setLogin_client($row->login_client);
            $client->setPass_client($row->pass_client);
            $client->setStatus_client($row->status_client);
            
            array_push($tabClient, $client);
        }
            return $tabClient;
    }

    public function clientItem(Client $cl){
        $sql = "SELECT * FROM clients WHERE id_client = :id";
        $result = $this -> getRequest($sql, ["id" =>$cl->getId_client() ]);

        if($result -> rowCount() > 0){
            $clientRow = $result->fetch(PDO::FETCH_OBJ);

            $clientItem = new Client();

            $clientItem->setId_client($clientRow->id_client);
            $clientItem->setName_client($clientRow->name_client);
            $clientItem->setFirstname_client($clientRow->firstname_client);
            $clientItem->setaddress($clientRow->address);
            $clientItem->setCp($clientRow->cp);
            $clientItem->setCity($clientRow->city);
            $clientItem->setCountry($clientRow->country);
            $clientItem->setEmail_client($clientRow->email_client);
            $clientItem->setInscription($clientRow->inscription);
            $clientItem->setLogin_client($clientRow->login_client);
            $clientItem->setPass_client($clientRow->pass_client);
            $clientItem->setStatus_client($clientRow->status_client);
            
            return $clientItem;
        }
    }

    public function insertClient(Client $insertC){
        // $req = "SELECT * FROM clients WHERE  email_client = :email";
        // $res = $this -> getRequest($req, ["email" => $insertC -> getEmail_client()]);

        // if($res -> rowCount() == 0){
            $sql = "INSERT INTO clients(name_client, firstname_client, address, cp, city, country, email_client, login_client, pass_client,  status_client)
                    VALUES (:name, :firstname, :address, :cp, :city, :country, :email, :login, :pass, :status)";
        
            $tabParams = [
                            "name"=>$insertC->getName_client(),
                            "firstname"=>$insertC->getFirstname_client(),
                            "address"=>$insertC->getAddress(),
                            "cp"=>$insertC->getCp(),
                            "city"=>$insertC->getCity(),
                            "country"=>$insertC->getCountry(),
                            "email"=>$insertC->getEmail_client(),
                            "login"=>$insertC->getLogin_client(),
                            "pass"=>$insertC->getPass_client(),
                            "status"=>$insertC->getStatus_client()
                        ];           
            $result = $this -> getRequest($sql, $tabParams);

            return $result;
        // }else{
        //     $message = "Ce compte existe déjà";
        //     echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
        // }
    }

    public function updateClient(Client $upCl){
        $sql = "UPDATE clients
                SET name_client = :name, firstname_client = :firstname, address = :address, cp = :cp, city = :city, country = :country, email_client = :email, inscription = :inscription, login_client = :login, pass_client = :pass,  status_client = :status
                WHERE id_client = :id";

        $tabParams = [
                        "id"=>$upCl->getId_client(),
                        "name"=>$upCl->getName_client(),
                        "firstname"=>$upCl->getFirstname_client(),
                        "address"=>$upCl->getAddress(),
                        "cp"=>$upCl->getCp(),
                        "city"=>$upCl->getCity(),
                        "country"=>$upCl->getCountry(),
                        "email"=>$upCl->getEmail_client(),
                        "inscription"=>$upCl->getInscription(),
                        "login"=>$upCl->getLogin_client(),
                        "pass"=>$upCl->getPass_client(),
                        "status"=>$upCl->getStatus_client()
                    ];
                           
        $result = $this -> getRequest($sql, $tabParams);

        return $result -> rowCount();
    }

    public function updateStatusClient(Client $clStat){
        $sql = "UPDATE clients SET status_client = :status WHERE id_client = :id";
        $result = $this -> getRequest($sql, ['status' => $clStat -> getStatus_client(), 'id' => $clStat -> getId_client()]);
        return $result -> rowCount();
    }

    public function signInClient($loginEmail, $pass){
        $sql = "SELECT * FROM clients
                WHERE (login_client = :logEmail OR email_client = :logEmail) AND pass_client = :pass";
                
        $result = $this -> getRequest($sql, ["logEmail" => $loginEmail, "pass" => $pass]);
        
        $row = $result -> fetch(PDO::FETCH_OBJ);

        return $row;
    }
}
    