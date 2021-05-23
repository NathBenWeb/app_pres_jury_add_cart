<?php ob_start(); 

?>

<div class="container">
    <h1 class="text-center text-decoration-underline mb-4 mt-4">Formulaire de modification client n° <?=$updateC->getId_client();?></h1>
    <div class="row">
        <div class="col-8 offset-2">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="">
                <div class="row mt-3">
                    <div class="col">
                        <label for="id">Id</label>
                        <input class="form-control" type="text" value="<?=$updateC->getId_client();?>" name="id" readonly>
                    </div>
                    <div class="col">
                        <label for="name">Nom</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?=$updateC->getName_client();?>">
                    </div>
                    <div class="col">
                        <label for="firstname">Prénom</label>
                        <input type="text" id="firstname" name="firstname" class="form-control" value="<?=$updateC->getFirstname_client();?>">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="address">Adresse</label>
                        <input type="address" id="address" name="address" class="form-control" value="<?=$updateC->getAddress();?>">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="cp">cp</label>
                        <input type="cp" id="cp" name="cp" class="form-control" value="<?=$updateC->getCp();?>">
                    </div>
                    <div class="col">
                        <label for="city">Ville</label>
                        <input type="city" id="city" name="city" class="form-control" value="<?=$updateC->getCity();?>">
                    </div>
                    <div class="col">
                        <label for="country">Pays</label>
                        <input type="country" id="country" name="country" class="form-control" value="<?=$updateC->getCountry();?>">
                    </div>
                </div> 
                <div class="row mt-3">
                    <div class="col">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?=$updateC->getEmail_client();?>">
                    </div>
                    <div class="col">
                        <label for="inscription">Inscription</label>
                        <input type="inscription" id="inscription" name="inscription" class="form-control" value="<?=$updateC->getInscription();?>" readonly>
                    </div>
                </div>     
                <div class="row mt-3">
                    <div class="col">
                        <label for="login">Login</label>
                        <input type="text" id="login" name="login" class="form-control" value="<?=$updateC->getLogin_client();?>">
                    </div>
                    <div class="col">
                        <label for="pass">Pass</label>
                        <input type="password" id="pass" name="pass" class="form-control" value="<?=$updateC->getPass_client();?>">
                    </div>
                </div>
                <button type="submit" class="btn col-12 mt-4" name="soumis" style="border-radius: 30px; color:rgb(174,140,95); background-color:rgb(3, 3, 29);">Modifier</button>
            </form>
        </div>
    </div>
</div>
<?php $contenu = ob_get_clean();
    require_once("./views/admin/templateAdmin.php");
?>