<?php

class MealController{
    private $adMeal;

    public function __construct(){
        $this -> adMeal = new MealModel();
        $this -> adChef = new ChefModel();
    }
 
    public function mealsList(){
        AuthController::isLogged();
        if(isset($_POST["soumis"]) && !empty($_POST["search"])){
            $search = trim(htmlentities(addslashes($_POST["search"])));
            echo  $search;
            $meals = $this->adMeal->getMeals($search);
            require_once("./views/admin/meals/mealsList.php");
        }else{
            $meals = $this->adMeal->getMeals();
            require_once("./views/admin/meals/mealsList.php");
        }
    }

    public function removeMeal(){
        AuthController::isLogged();
        AuthController::accessUser3();
        if(isset($_GET["id"]) && filter_var($_GET["id"], FILTER_VALIDATE_INT)){
            $id = $_GET["id"];
            $delM = new Meal;
            $delM->setId_meal($id);
            $nbLine = $this -> adMeal -> deleteMeal($delM);
    
            if($nbLine > 0){
                header("location:index.php?action=list_meals");
            }
        }
    }

    public function editMeal(){
        AuthController::isLogged();
        if(isset($_GET["id"]) && $_GET["id"] < 1000 && filter_var($_GET["id"], FILTER_VALIDATE_INT)){
            $id = trim($_GET["id"]);
            $editM = new Meal;
            $editM->setId_meal($id);

            //editMeal = variable à integrer dans la view pour appeler la valeur pour l'affichage
            $editMeal = $this -> adMeal-> mealItem($editM); 

        // Pour afficher toutes les catégories dans le form-select de la view
            $tabChef = $this -> adChef  -> getChefs();
        
            if(isset($_POST["soumis"]) && !empty($_POST["name_meal"]) && !empty($_POST["price"])){
        
                $name_meal = htmlentities(trim($_POST["name_meal"]));
                $start = htmlentities(trim($_POST["start"]));
                $dish = htmlentities(trim($_POST["dish"]));
                $dessert = htmlentities(trim($_POST["dessert"]));
                $price = htmlentities(trim($_POST["price"]));
                $id_chef = htmlentities(trim($_POST["id_chef"]));
                $picture_meal = $_FILES ["picture"]["name"];

                // On va modifier l'objet $editMeal créé plus haut dans le premier if
                $editMeal->setName_meal($name_meal);
                $editMeal->setStart($start);
                $editMeal->setDish($dish);
                $editMeal->setDessert($dessert);
                $editMeal->setPrice($price);
                $editMeal->setPicture_meal($picture_meal);
                $editMeal->getChef()->setId_chef($id_chef);
              
                
                // Pour pouvoir récupérer une image n'importe où et qu'elle s'importe dans le dossier image une fois téléchargée
                $destination = "./assets/pictures/";
                move_uploaded_file($_FILES["picture"]["tmp_name"], $destination.$picture_meal);

                $ok = $this->adMeal->updateMeal($editMeal);
                // if($ok > 0){
                    header("location:index.php?action=list_meals");
                // }
            }
            require_once("./views/admin/meals/editMeal.php");
        }
    }

    public function addMeal(){
        AuthController::isLogged();
        if(isset($_POST["soumis"]) && !empty($_POST["name_meal"]) && !empty($_POST["price"])){
    
            $name_meal = htmlspecialchars(trim($_POST["name_meal"]));
            $start = htmlspecialchars(trim($_POST["start"]));
            $dish = htmlspecialchars(trim($_POST["dish"]));
            $dessert = htmlspecialchars(trim($_POST["dessert"]));
            $price = htmlspecialchars(trim($_POST["price"]));
            $id_chef = htmlspecialchars(trim($_POST["id_chef"]));
            $picture_meal = $_FILES ["picture"]["name"];

            $newM = new Meal();
            $newM->setName_meal($name_meal);
            $newM->setStart($start);
            $newM->setDish($dish);
            $newM->setDessert($dessert);
            $newM->setPrice($price);
            $newM->setPicture_meal($picture_meal);
            $newM->getChef()->setId_chef($id_chef);
            
            // Pour pouvoir récupérer une image n'importe où et qu'elle s'importe dans le dossier image une fois téléchargée
            $destination = "./assets/pictures/";
            move_uploaded_file($_FILES["picture"]["tmp_name"], $destination.$picture_meal);

            $ok = $this->adMeal->insertMeal($newM);
            if($ok){
                header("location:index.php?action=list_meals");
            }
        }
        $tabChef = $this -> adChef  -> getChefs();

        require_once("./views/admin/meals/addMeal.php");
    }
}