<?php ob_start();?>

<div id="contact_container" class="container" >

<?php if(isset($valid)){  ?>
<?php } ?>
    <section id="inscription">
        <h1 id="titreInscription">Bonjour <?php if(isset($_SESSION['AuthClient'])){
            echo $_SESSION['AuthClient']->firstname_client;
            } ?>, veuillez modifiez votre profile
        </h1>

        <form id="contact-form" action="<?php $_SERVER["PHP_SELF"];?>" method="post" class="input-group row g-3">
            <?php
                if(isset($erreur)){
                    echo $erreur;
                }
            ?>
            <div class="col-md-12">
                <label for="name">Nom</label>
                <input type="name" name="name" class="form-control" id="inputName" value="<?=$editProfile->getName_client();?>"/>
            </div>
            <div class="col-md-12">
            <label for="firstname">Prénom</label>
                <input type="firstname" name="firstname" class="form-control" id="inputFirstname" value="<?=$editProfile->getFirstname_client();?>"/>
            </div>
            <div>
                <label for="address">Adresse</label>
                <input type="text" name="address" class="form-control" id="inputAddress" value="<?=$editProfile->getAddress();?>"/>
            </div>
            <div class="col-md-4">
            <label for="cp">Code postal</label>
                <input type="number" name="cp" class="form-control" id="inputZip" value="<?=$editProfile->getCp();?>"/>
            </div>
            <div class="col-md-8">
                <label for="city">Ville</label>
                <input type="text" name="city" class="form-control" id="inputCity" value="<?=$editProfile->getCity();?>"/>
            </div>
            <div class="col-md-12">
                <label for="country">Pays</label>
                <input type="text" name="country" class="form-control" id="inputCountry" value="<?=$editProfile->getCountry();?>"/>
            </div>
            <div class="col-md-12">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail4" value="<?=$editProfile->getEmail_client();?>"/>
            </div>
            <div class="col-md-12">
                <label for="login">Login</label>
                <input type="login" name="login" class="form-control" id="inputLogin" value="<?=$editProfile->getLogin_client();?>"/>
            </div>
            <div>
                <label for="pass">Mot de passe</label>
                <input type="password" name="pass" class="form-control" id="inputPassword4" value="<?=$editProfile->getPass_client();?>"/>
            </div>
            <div id="buttonContact" class="col-12">
                <button type="submit" name="soumis" class="btn" style="border-radius: 30px; background-color:rgb(174,140,95); color: #f2f2f2;">Modifier</button>
            </div>
        </form>
    </section> 
</div>
    
                   


<?php
    $contenu = ob_get_clean();
    require_once('./views/public/templatePublic.php');
?>

