<?php ob_start();?>

<div id="contact_container" class="container" >
            <section id="inscription">
                <h1 id="titreInscription">Formulaire d'inscription</h1>
                    <form id="contact-form" action="<?php $_SERVER["PHP_SELF"];?>" method="post" class="input-group row g-3">
                
                    <div class="col-12 ">
                    <img class="fit-picture" src="./assets/pictures/contact.png" alt="" width="100%"/>
                    </div>
                        <h2 id="titreImg" class="">Rejoignez-nous !</h2>
                        <?php
                if(isset($erreur)){
                    echo $erreur;
                }
                ?>
                    <div class="col-md-12">
                        <input type="name" name="name" class="form-control" id="inputName" placeholder="Entrez votre nom" required/>
                    </div>
                    <div class="col-md-12">
                        <input type="firstname" name="firstname" class="form-control" id="inputFirstname" placeholder="Entrez votre prénom" required/>
                    </div>
                    <div>
                        <input type="text" name="address" class="form-control" id="inputAddress" placeholder="N° et nom de la voie" required/>
                    </div>
                    <div class="col-md-4">
                        <input type="number" name="cp" class="form-control" id="inputZip" placeholder="CP" required/>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="city" class="form-control" id="inputCity" placeholder="Ville" required/>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="country" class="form-control" id="inputCountry" placeholder="Pays" required/>
                    </div>
                    <div class="col-md-12">
                        <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Entrez votre email" required/>
                    </div>
                    <div class="col-md-12">
                        <input type="email" name="email2" class="form-control" id="inputEmail4" placeholder="Confirmez votre email" required/>
                    </div>
                    <div class="col-md-12">
                        <input type="login" name="login" class="form-control" id="inputLogin" placeholder="Choisissez votre login" required/>
                    <?php $login?>
                    </div>
                    <div>
                        <input type="password" name="pass" class="form-control" id="inputPassword4" placeholder="Choisissez votre mot de passe" required/>
                    </div>
                    <div>
                        <input type="password" name="pass2" class="form-control" id="inputPassword4" placeholder="Confirmez votre mot de passe" required/>
                    </div>
                    <div class="col-12">
                        <div id="check" class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck" required/>
                            <label class="form-check-label" for="gridCheck">*J'accepte les conditions générales d'utilisation Un chef à la maison</label>
                        </div>
                    </div>
                    <div id="buttonContact" class="col-12">
                        <button type="submit" name="soumis" class="btn" style="border-radius: 30px; background-color:rgb(174,140,95); color: #f2f2f2;">Je m'inscris</button>
                    </div>
                </form>
                
            </section>

            
        </div>

<?php $contenu = ob_get_clean();
    require_once("./views/public/templatePublic.php");
?>