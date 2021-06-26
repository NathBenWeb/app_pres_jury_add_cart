<?php

require_once('./vendor/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class OrderControllerAdmin{
    private $orderModel;
    private $model;

    public function __construct(){
            $this->orderModel = new OrderModel();
        }

public function addOrder(){
        $date = $_SESSION['pay']['date'];
        $price = $_SESSION['pay']['price'];
        $nom = $_SESSION['pay']['name_client'];
        $prenom = $_SESSION['pay']['firstname_client'];
        $email = $_SESSION['pay']['email'];

        $order = new Order();
        $order->setDate($date);
        $order->setPrenom($prenom);
        $order->setNom($nom);
        $order->setMontant($price);
        $order->setEmail($email);

       $result = $this->orderModel->insertOrder($order);

        foreach($_SESSION['cart'] as $key => $cart){

                    $id_meal= $cart['id_meal'];
                    $contain = new Contain();
                    $contain->getOrder()->setId_order($result);
                    $contain->setId_meal($id_meal);

                     var_dump($contain);
                 $res =    $this->orderModel->insertContain($contain);
                }
                if($res){
                     
               
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
            $mail->addAddress("$email", 'Mr/Mme ');
            

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Confirmation de commande';
            $mail->Body = '<h3>Votre commande est confirmée</h3>';
            $mail->send();
            echo 'Votre email a bien été envoyé au client';
        }catch (Exception $e) {
            echo "Votre message n'a pas pu être envoyé. Mailer Error: {$mail->ErrorInfo}";
        }
        session_unset();
        require_once("./views/public/success.php");
    }
}



    public function SelectOrders(){
        $orders = $this->orderModel->getOrders();
        require_once("./views/admin/order/orderList.php");

    }
}