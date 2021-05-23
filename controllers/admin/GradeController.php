<?php

class GradeController{
   private $adminGrade;

   public function __construct(){
        $this -> adminGrade = new GradeModel();
   }

   public function gradesList(){
        AuthController::isLogged();
        AuthController::accessUser2();
        AuthController::accessUser3();
        $allGrade = $this -> adminGrade -> getGrades();
        require_once("./views/admin/grades/gradesList.php");
   }

   public function removeGrade(){
        AuthController::isLogged();
        AuthController::accessUser2();
        AuthController::accessUser3();
        if(isset($_GET["id"]) && $_GET["id"] < 1000 && filter_var($_GET["id"], FILTER_VALIDATE_INT)){
            $id = trim($_GET["id"]);
        
            $nbLine = $this -> adminGrade -> deleteGrade($id);

            if($nbLine > 0){
                header("location:index.php?action=list_grades");
            }
        }
   }
   
   public function editGrade(){
       AuthController::isLogged();
       AuthController::accessUser2();
       AuthController::accessUser3();
       if(isset($_GET["id"]) && $_GET["id"] < 1000 && filter_var($_GET["id"], FILTER_VALIDATE_INT)){
           $id = trim($_GET["id"]);
           $grade = $this -> adminGrade -> gradeItem($id);
           
           if(isset($_POST["soumis"]) && !empty($_POST["grade"])){
               $gr = trim(addslashes((htmlentities($_POST["grade"]))));
               $grade -> setName_grade($gr);
               $this -> adminGrade -> updateGrade($grade);
               header("location:index.php?action=list_grades");
            }
        require_once("./views/admin/grades/editGrade.php");
        }
   }

   public function addGrade(){
       AuthController::isLogged();
       AuthController::accessUser2();
       AuthController::accessUser3();
       if(isset($_POST["soumis"]) && !empty($_POST["grade"])){
           $name_grade = trim(strip_tags(addslashes((htmlentities($_POST["grade"])))));
           $newGrade = new Grade();
           $newGrade ->setName_grade($name_grade);
           $ok = $this -> adminGrade-> insertGrade($newGrade);
           
           if($ok){
               header("location:index.php?action=list_grades");
            }
    }
    require_once("./views/admin/grades/addGrade.php");
   }  
}

