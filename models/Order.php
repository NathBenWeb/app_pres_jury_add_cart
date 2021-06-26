<?php

class Order{

private $id_order;
private $date;
private $montant;
private $nom;
private $prenom;
private $email;

public function __construct(){

}

/**
 * Get the value of id_order
 */ 
public function getId_order()
{
return $this->id_order;
}

/**
 * Set the value of id_order
 *
 * @return  self
 */ 
public function setId_order($id_order)
{
$this->id_order = $id_order;

return $this;
}

/**
 * Get the value of date
 */ 
public function getDate()
{
return $this->date;
}

/**
 * Set the value of date
 *
 * @return  self
 */ 
public function setDate($date)
{
$this->date = $date;

return $this;
}

/**
 * Get the value of montant
 */ 
public function getMontant()
{
return $this->montant;
}

/**
 * Set the value of montant
 *
 * @return  self
 */ 
public function setMontant($montant)
{
$this->montant = $montant;

return $this;
}

/**
 * Get the value of nom
 */ 
public function getNom()
{
return $this->nom;
}

/**
 * Set the value of nom
 *
 * @return  self
 */ 
public function setNom($nom)
{
$this->nom = $nom;

return $this;
}

/**
 * Get the value of prenom
 */ 
public function getPrenom()
{
return $this->prenom;
}

/**
 * Set the value of prenom
 *
 * @return  self
 */ 
public function setPrenom($prenom)
{
$this->prenom = $prenom;

return $this;
}

/**
 * Get the value of email
 */ 
public function getEmail()
{
return $this->email;
}

/**
 * Set the value of email
 *
 * @return  self
 */ 
public function setEmail($email)
{
$this->email = $email;

return $this;
}
}