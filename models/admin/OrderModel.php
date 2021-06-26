<?php

class OrderModel extends Driver{

    public function insertOrder(Order $order){
       
       $sql = 'INSERT INTO orders(date_order, order_amount,nom_ct_cart,prenom_ct_cart, email_ct_cart)
                VALUES(:date_order,:order_amount,:nom_ct_cart,:prenom_ct_cart,:email_ct_cart)';
        $tabParams = [
                        "date_order"=>$order->getDate(),
                        "order_amount"=>$order->getMontant(),
                        "nom_ct_cart"=>$order->getNom(),
                        "prenom_ct_cart"=>$order->getPrenom(),
                        "email_ct_cart"=>$order->getEmail(),
                    ];             
        $result = $this->getRequest($sql,$tabParams);
      
        if($result){
            return $this->getLastInsertId();
          }

    }
    public function insertContain(Contain $conatin){
       
        $sql = 'INSERT INTO to_contain(id_order, id_meal)
                 VALUES(:id_order,:id_meal)';
         $tabParams = [
                         "id_order"=>$conatin->getOrder()->getId_order(),
                         "id_meal"=>$conatin->getId_meal(),
                     ];             
         $result = $this->getRequest($sql,$tabParams);
       
         if($result){
             return $result;
           }
     }

     public function getOrders(){

        $sql="SELECT * FROM orders";
        $result = $this->getRequest($sql);
        $orders = $result->fetchAll(PDO::FETCH_OBJ);

        $taborders = [];
        foreach($orders as $order){
            $m = new Order();
            $m->setId_order($order->id_order);
            $m->setDate($order->date_order);
            $m->setNom($order->nom_ct_cart);
            $m->setPrenom($order->prenom_ct_cart);
            $m->setMontant($order->order_amount);
            $m->setEmail($order->email_ct_cart);
            array_push($taborders, $m);
        }
        return $taborders;
     }
}