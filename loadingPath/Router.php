<?php

    require_once("./loadingPath/autoload.php");

class Router{
    private $ctrUser;
    private $ctrGrade;
    private $ctrChef;
    private $ctrMeal;
    private $ctrAdminClient;
    private $ctrPublicClient;
    private $ctrPublic;

    public function __construct(){
        $this -> ctrUser = new UserController;
        $this -> ctrGrade = new GradeController;
        $this -> ctrChef = new ChefController;
        $this -> ctrMeal = new MealController;
        $this -> ctrAdminClient = new ClientAdminController;
        $this -> ctrPublicClient = new ClientPublicController;
        $this -> ctrPublic = new PublicController;
    }

    public function getPath(){
        try{
            if(isset($_GET["action"])){
                switch($_GET["action"]){
                    // ------------------------login/logout Admin-------------
                    case "login_admin" :
                        $this->ctrUser->loginAdmin();
                        break;
                    case "logout_admin" :
                        AuthController::logout();
                        break;
                    case "transferShop" :
                        AuthController::logoutAndTransferShop();
                        break; 
                    // -----------------------login/logout Public-------------
                    case "sign_in" :
                        $this->ctrPublicClient->loginClient();
                        break;
                    case "sign_out" :
                        AuthController::logoutClient();
                        break;
                    case "transferAdmin" :
                        AuthController::logoutAndTransferAdmin();
                        break;                    
                    // --------------------------------Users Admin-------------
                    case "list_users" :
                        $this->ctrUser->usersList(); 
                        break;
                    case "edit_user" :
                        $this->ctrUser->editUser();
                        break;
                    case "register_user" :
                        $this->ctrUser->addUser();
                        break;
                    // ------------------------------Grades Admin-------------
                    case "list_grades" :
                        $this->ctrGrade->gradesList();
                        break;
                    case "edit_grade" :
                        $this->ctrGrade->editGrade();
                        break;
                    case "add_grade" :
                        $this->ctrGrade->addGrade();
                        break;
                    case "delete_grade" :
                        $this->ctrGrade->removeGrade();
                        break;
                    // --------------------------------Chefs Admin-------------
                    case "list_chefs" :
                        $this->ctrChef->chefsList();
                        break;
                    case "delete_chef" :
                        $this->ctrChef->removeChef();
                        break;
                    case "edit_chef" :
                        $this->ctrChef->editChef();
                        break;
                    case "add_chef" :
                        $this->ctrChef->addChef();
                        break;
                    // --------------------------------Meals Admin-------------
                    case "list_meals" :
                        $this->ctrMeal->mealsList();
                        break;
                    case "add_meal" :
                        $this->ctrMeal->addMeal();
                        break;
                    case "delete_meal" :
                        $this->ctrMeal->removeMeal();
                        break;
                    case "edit_meal" :
                        $this->ctrMeal->editMeal();
                        break;
                    // --------------------------------AdminClients-------------
                    case "list_clients" :
                        $this->ctrAdminClient->clientsList(); 
                        break;
                    case "edit_client" :
                        $this->ctrAdminClient->editClient();
                        break;
                    case "register_client" :
                        $this->ctrAdminClient->addClient();
                        break;
                    // --------------------------------PublicClients-------------
                    case "sign_up" :
                        $this->ctrPublicClient->signUpClient(); 
                        break;
                    case "profile_client" :
                        $this->ctrPublicClient->profileClient();
                        break;
                    // --------------------------------Dynamic public pages-------------
                    case "shop" :
                        $this->ctrPublic-> getPubMeals();
                        break;
                    case "chefs" :
                        $this->ctrPublic-> chefsSlides();
                        break;
                    case "checkout" :
                        $this->ctrPublic->recap();
                        break;
                    case "pay" :
                        $this->ctrPublic->payment();
                        break;
                    case "success" :
                        $this->ctrPublic->confirmation();
                        break;
                    case "validation" :
                        $this->ctrPublic->validation();
                        break;
                    case "cancel" :
                        $this->ctrPublic->cancel();
                        break;
                    // --------------------------------Static public pages-------------
                    case "home" :
                        $this->ctrPublic->home();
                        break;
                    case "contact" :
                        $this->ctrPublic->contact();
                        break;
                    case "about" :
                        $this->ctrPublic->about();
                        break;
                    case "cancel" :
                        $this->ctrPublic->cancel();
                        break;  
                 default:
                        throw new Exception("Action non définie");      
                }
            }
            else{
                $this->ctrPublic->home();
                session_unset();
            }
        }catch(Exception $e){
            $this->page404($e->getMessage());
        }
    }
    private function page404($errorMsg){
        require_once("./views/notFound.php");
    }
}