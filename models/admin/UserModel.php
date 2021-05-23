<?php

class UserModel extends Driver{
    
    public function getUsers(){
        $sql ="SELECT * FROM users u
                INNER JOIN grades g
                ON u.id_g = g.id_g
                ORDER BY u.id_user";

        $result = $this->getRequest($sql);

        $rows = $result->fetchAll(PDO::FETCH_OBJ);
        $tabUser = [];

        foreach($rows as $row){
            $user = new User();
            $user->setId_user($row->id_user);
            $user->setFirstname($row->firstname);
            $user->setName($row->name);
            $user->setLogin($row->login);
            $user->setPass($row->pass);
            $user->setEmail($row->email);
            $user->setStatus($row->status);
            $user->getGrade()->setId_g($row->id_g);
            $user->getGrade()->setName_grade($row->name_grade);
            
            array_push($tabUser, $user);
        }
            return $tabUser;
    }

    public function userItem(User $user){
        $sql = "SELECT * FROM users WHERE id_user = :id";
        $result = $this -> getRequest($sql, ["id" =>$user->getId_user() ]);

        if($result -> rowCount() > 0){
            $userRow = $result->fetch(PDO::FETCH_OBJ);

            $editUser = new User();
            $editUser -> setId_user($userRow->id_user);
            $editUser -> setFirstname($userRow->firstname);
            $editUser -> setName($userRow->name);
            $editUser -> setLogin($userRow->login);
            $editUser -> setPass($userRow->pass);
            $editUser -> setEmail($userRow->email);
            $editUser -> getGrade()->setId_g($userRow->id_g);
            return $editUser;
        }
    }

    public function updateUser(User $updateU){
        $sql = "UPDATE users
                SET firstname = :firstname, name = :name, login = :login, pass = :pass, email = :email, id_g = :id_g,
                status = :status
                WHERE id_user = :id";

        $tabParams = [
                        "id"=>$updateU->getId_user(),
                        "firstname"=>$updateU->getFirstname(),
                        "name"=>$updateU->getName(),
                        "login"=>$updateU->getLogin(),
                        "pass"=>$updateU->getPass(),
                        "email"=>$updateU->getEmail(),
                        "status"=>$updateU->getStatus(),
                        "id_g"=>$updateU->getGrade()->getId_g() 
                    ];
                           
        $result = $this -> getRequest($sql, $tabParams);

        return $result -> rowCount();
    }

    public function insertUser(User $us){
        $req = "SELECT * FROM users WHERE  email = :email";
        $res = $this -> getRequest($req, ["email" => $us -> getEmail()]);
        
        if($res -> rowCount() == 0){
            $sql = "INSERT INTO users(firstname, name, login, pass, email, status, id_g)
                    VALUES (:firstname, :name, :login, :pass, :email, :status, :id_g)";
        
            $tabParams = [
                            "firstname"=>$us->getFirstname(),
                            "name"=>$us->getName(),
                            "login"=>$us->getLogin(),
                            "pass"=>$us->getPass(),
                            "email"=>$us->getEmail(),
                            "status"=>$us->getStatus(),
                            "id_g"=>$us->getGrade()->getId_g()
                        ];             
            $result = $this -> getRequest($sql, $tabParams);

        return $result;
        
        }else{
            $message = "Cet utilisateur existe déjà";
            echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
        }
    }
   
    public function updateStatus(User $usStat){
        $sql = "UPDATE users SET status = :status WHERE id_user = :id";
        $result = $this -> getRequest($sql, ['status' => $usStat -> getStatus(), 'id' => $usStat -> getId_user()]);
        return $result -> rowCount();
    }

    public function signIn($loginEmail, $pass){
        $sql = "SELECT * FROM users
                WHERE (login = :logEmail OR email = :logEmail) AND pass = :pass";
        $result = $this -> getRequest($sql, ["logEmail" => $loginEmail, "pass" => $pass]);
        
        $row = $result -> fetch(PDO::FETCH_OBJ);

        return $row;
    }

}