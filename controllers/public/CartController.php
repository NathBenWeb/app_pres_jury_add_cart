<?php
session_start();

require_once('./vendor/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class PublicController{
    private $pubMeal;
    private $pubChef;
    private $pubModel;

    public function __construct(){
        $this -> pubMeal = new MealModel();
        $this -> pubChef = new ChefModel();
        $this -> pubModel = new PublicModel();
        
    }

    public function getPubMeals(){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            if( isset($_POST['soumis']) && !empty($_POST['search'])){
                $search = trim(htmlspecialchars(addslashes($_POST['search'])));
                $tabChef = $this->pubChef->getChefs();
                $meals = $this->pubMeal->getMeals($search);
                require_once('./views/public/shop.php');
            }
            
            $id = trim(htmlentities(addslashes($_GET['id'])));
            $m = new Meal();
            $m->getChef()->setId_chef($id);
            $tabChef = $this->pubChef->getChefs();
            $menus = $this->pubModel->findMealByChef($m);
            require_once('./views/public/chefMeals.php');
      
        }else{
            if( isset($_POST['soumis']) && !empty($_POST['search'])){
                $search = trim(htmlspecialchars(addslashes($_POST['search'])));
                $tabChef = $this->pubChef->getChefs();
                $meals = $this->pubMeal->getMeals($search);
                require_once('./views/public/shop.php');
            }
            $tabChef = $this->pubChef->getChefs();
            $meals = $this->pubMeal->getMeals();


            require_once('./views/public/shop.php');
        }
    }


    public function recap(){ //add panier
        if(isset($_POST["envoi"]) && !empty($_POST["name_meal"]) && !empty($_POST["price"])){
            $id_meal = htmlspecialchars(addslashes($_POST["id_meal"]));
            $name_meal = htmlspecialchars(addslashes($_POST["name_meal"]));
            $picture_meal = htmlspecialchars(addslashes($_POST["picture_meal"]));
            $name_chef = htmlspecialchars(addslashes($_POST["name_chef"]));
            $price = htmlspecialchars(addslashes($_POST["price"]));
            $total=0;
        }

            $newM = new Meal();
            $newM->setId_meal($id_meal);
            $newM->setName_meal($name_meal);
            $newM->setPicture_meal($picture_meal);
            $newM->setPrice($price);
            $newM->getChef()->setName_chef($name_chef);

            $ok = $this->pubMeal->getMeals();
            if($ok){
                for($i = 0; $i < count($_POST[$id_meal]); $i++){
                    $total += $_POST[$id_meal][$i] * $_POST[$id_meal][$price][$i];
                }
                return $total;
                header("location:index.php?action=shop&id");
            }
            $tabChef = $this -> pubChef -> getChefs();
            require_once('./views/public/mealItem.php');
        
    }
   

    // public function removePanier(){ //Remove test
    //     if(isset($_GET["id"]) && filter_var($_GET["id"], FILTER_VALIDATE_INT)){
    //         $id = $_GET["id"];
    //         $delM = new Meal;
    //         $delM->setId_meal($id);
    //         $nbLine = $this -> pubMeal->getMeals();
    
    //         if($nbLine > 0){
    //             header("location:index.php?action=checkout");
    //         }
    //     }
    //     require_once('./views/public/mealItem.php');
    // }
   
    

    public function payment(){
// var_dump($_POST);
       
        if(isset($_POST) && !empty($_POST['email'])){

            \Stripe\Stripe::setApiKey('sk_test_51IM8bvL6FL0Y9IWw4LZMREUr9FM3PaNP26KsYr225kTNReAsL4qOY9xY9vcXXjY0u5kPBKSzVUCfgrFdOsrKbqV500v4fZaacP');

            header('Content-Type: application/json');

            $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                'currency' => 'eur',
                'unit_amount' =>  $_POST['price']*100,
                'product_data' => [
                    'name' => $_POST['name_meal']." - ".$_POST['name_chef'],
                    'images' => ["https://imgshare.io/images/2021/04/20/paiement.jpg"],
                ],
                ],
                'quantity' => $_POST["quantity"],
            ]],
            'customer_email' => $_POST['email'],
            'mode' => 'payment',
            'success_url' => 'http://localhost/php/oriente_objet/apps/app_pres_jury/index.php?action=success',
            'cancel_url' => 'http://localhost/php/oriente_objet/apps/app_pres_jury/index.php?action=cancel',
            ]);

            $_SESSION['pay'] = $_POST;
            echo json_encode(['id' => $checkout_session->id]);
        }
    }

    public function confirmation(){
        // (int)$_SESSION["pay"]["quantite"];
        $meal = new Meal();
        $meal -> setId_meal($_SESSION["pay"]["id_meal"]);
        $email = $_SESSION["pay"]["email"];
        $name_meal = $_SESSION["pay"]["name_meal"];
        $name_chef = $_SESSION["pay"]["name_chef"];
        $price = $_SESSION["pay"]["price"];

        $client = new Client();
        $client -> getFirstname_client();

        $mail = new PHPMailer(true);
     
            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
                $mail->isSMTP();                                           
                $mail->Host       = 'smtp.gmail.com';                     
                $mail->SMTPAuth   = true;                                   
                $mail->Username   = 'nathaliebendavidweb@gmail.com';                    
                $mail->Password   = 'osbtdjoxdsxsrvlu';                               
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
                $mail->Port       = 587;

                //Recipients
                $mail->setFrom('nathaliebendavidweb@gmail.com', 'Un Chef à la maison');
                $mail->addAddress("$email", 'Mr/Mme');
                

                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Confirmation de commande';
                $mail->Body = '<h3>Votre commande est confirmée</h3>
                                <div>
                                    <b>Nom menu: </b>'.$name_meal.'
                                    <b>Nom chef: </b>'.$name_chef.'
                                    <b>Prix: </b>'.$price.'
                                    <p>Nous vous remercions pour votre achat</p>
                                </div>';

                $mail->send();
                echo 'Votre email a bien été envoyé au client';
            }catch (Exception $e) {
                echo "Votre message n'a pas pu être envoyé. Mailer Error: {$mail->ErrorInfo}";
            }
        
            require_once("./views/public/success.php");
    }
    
    public function validation(){
        require_once('./views/public/validation.php');
    }

    public function cancel(){
        require_once("./views/public/cancel.php");
    }
}