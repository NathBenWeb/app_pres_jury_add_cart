<?php ob_start(); ?>
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

      <tbody id="tabCart">
      <?php
        $prods = "";
        foreach($_SESSION['cart'] as $cart){
        
      ?>
        <tr class="text-center">
          <td><img src="./assets/pictures/<?=$cart['picture_meal']?>" alt="..." width="90px"></td>
          <td><?=$cart['name_meal']?></td>
          <td>by <?=$cart['name_chef']?></td>
          <td ><?=($cart['price'])?>.00<input class="itemPrice" type="hidden" value="<?=($cart['price'])?>"></td>
          <td><input type="number" id="quant" name="quant" class="itemQt form-control" min="1" value="1" max="10"></td>
          <td class="itemTotal"></td>
          <td  class="text-center"><a class="btn" id="deleteCartItem" href="index.php?action=updateCart&id=<?=$cart['id_meal']?>"onclick="return confirm('Etes vous sûr de vouloir supprimer')"><i class="fas fa-trash"></i></a></td>
        </tr>
      <?php } ?>
      </tbody>
    </table>
<!-- Message panier vide --> 
    <?php if(count($_SESSION['cart']) === 0){?>
      <div class="alert alert-danger text-center">Votre panier est vide</div>
    <?php } ?>
<!-- Bouton retour shop-->   
    <a class="btn" id="returnShop" href="index.php?action=shop"><i class="fas fa-undo-alt" style="color:rgb(174,140,95);" aria-hidden="true"></i> Continuez vos achats</a>
  </section>

<!-- Section frais livraison, total et paiement-->
  <section class="sectionCart2 mt-5">
    <div id="validation" class="ml-5 border p-3 mt-5">
<!-- Message Menu déjà ajouté au panier-->  
      <form>
        <label class="" for="date">Date de livraison souhaitée*</label>
        <input type="date" id="date" class="form-control mb-2" required>
        <label for="totalMenu">Prix total menu</label>
        <textarea type="text"id="totalMenu" class="form-control mb-2" rows="1" readonly></textarea>
        <label for="email" id="emailValider">Email*</label>
        <input type="email"id="email" class="form-control" placeholder="Veuillez saisir votre email...">
        <label for="firstname_client" id="firstnameValider">Prénom*</label>
        <input type="text"id="firstname" class="form-control" placeholder="Veuillez saisir votre prénom...">
        <label for="name_client" id="nameValider">Nom*</label>
        <input type="text"id="name" class="form-control" placeholder="Veuillez saisir votre nom...">
<!-- Input hidden appelés dans la page paiement stripe (voir js stripe)-->
        <input type="hidden" id="prods" value="<?=$prods?>">
        <button type="button" id="checkout-button" class="btn  col-12 mt-3">Valider ma commande</button>
      </form>
    </div>
  </section>
</div>

<?php $contenu = ob_get_clean();
    require_once("./views/public/templatePublic.php");
?>