<?php ob_start(); 
// var_dump($_SESSION['cart']);
?>
<!-- Section Panier-->
<div id="" class="container d-flex">
  <section class="sectionCart1">
    <table id="tableCart" class="table table-striped">
      <thead>
        <tr class="text-center">
          <th>Image</th>
          <th class="col-md-3">Menu</th>
          <th class="col-md-3">Chef</th>
          <th class="col-md-1">Prix</th>
          <th class="col-sm-1">Quantité</th>
          <th class="col-md-2">Sous-total</th>
          <th>Actions</th>
        </tr>
      </thead>
      
      <tbody class="tabCart" id="tabCart">
      <?php
       if(isset($_SESSION['cart'])){
        $meals = "";
        foreach($_SESSION['cart'] as $key => $cart){
        
      ?>
        <tr class="text-center">
          <td><img src="./assets/pictures/<?=$cart['picture_meal']?>" alt="..." width="90px"></td>
          
          <td><?=$cart['name_meal']?></td>
          <td>by <?=$cart['name_chef']?></td>
          <td><?=($cart['price'])?><input type="hidden" id="priceItem" class="priceItem" value="<?=$cart['price']?>"></td>
          <td><input type="number" step="1" name="quant"  class="qteItem" min="1" max="10"></td>
          <td class="totalItem"></td>
          <td  class="text-center">
          <a class="btn" id="deleteCartItem" href="index.php?action=updateCart&id=
          <?=$cart['id_meal']?>"onclick="return confirm('Etes vous sûr de vouloir supprimer')">
          <i class="fas fa-trash"></i></a></td>

          <input type="hidden" id="idMeal" class="idMeal" value="<?=$cart['id_meal']?>">
        </tr>
      <?php }} ?>
      </tbody>
    </table>
<!-- Message panier vide --> 
<?php

    
if( !isset($_SESSION['cart']) || count($_SESSION['cart']) === 0){?>
  <div class="alert alert-danger text-center">Votre panier est vide</div>
<?php }?>
<!-- Bouton retour shop-->   
    <a class="btn" id="returnShop" href="index.php?action=shop"><i class="fas fa-undo-alt" style="color:rgb(174,140,95);" aria-hidden="true"></i> Continuez vos achats</a>
  </section>
  <section class="sectionCart2">
    <div id="validation" class="ml-5 border p-3 mt-5 mb-5">
<!-- Message Menu déjà ajouté au panier-->  
      <form>
        <label class="" for="date">Date de livraison souhaitée*</label>
        <input type="date" id="date" name="date" class="form-control mb-2" required>
        <label for="totalMeals">Prix total menu</label>
        <input type="text"id="totalMeals" class="form-control mb-2" rows="1" readonly></textarea>
        <label for="email" id="emailValider">Email*</label>
        <input type="email"id="email" class="form-control" placeholder="Veuillez saisir votre email...">
        <label for="firstname_client" id="firstnameValider">Prénom*</label>
        <input type="text"id="firstname" class="form-control" placeholder="Veuillez saisir votre prénom...">
        <label for="name_client" id="nameValider">Nom*</label>
        <input type="text"id="name" class="form-control" placeholder="Veuillez saisir votre nom...">
<!-- Input hidden appelés dans la page paiement stripe (voir js stripe)-->
        <input type="hidden" name="quant" id="quant"  class="form-control" min="1" value="1">
        <input type="hidden" id="ref" value="<?=$cart['id_meal']?>">
        <input type="hidden" id="meals" value="<?=$meals?>">
        <button type="button" id="checkout-button" class="btn  col-12 mt-3">Valider ma commande</button>
      </form>
    </div>
  </section>
</div>

<?php $contenu = ob_get_clean();
    require_once("./views/public/templatePublic.php");
?>