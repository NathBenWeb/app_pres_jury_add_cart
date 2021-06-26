<?php


class Contain{
    private $order;
    private $id_meal;


    public function __construct(){
        $this->order = new Order;
    }

    /**
     * Get the value of id_meal
     */ 
    public function getId_meal()
    {
        return $this->id_meal;
    }

    /**
     * Set the value of id_meal
     *
     * @return  self
     */ 
    public function setId_meal($id_meal)
    {
        $this->id_meal = $id_meal;

        return $this;
    }

    /**
     * Get the value of order
     */ 
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set the value of order
     *
     * @return  self
     */ 
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }
}