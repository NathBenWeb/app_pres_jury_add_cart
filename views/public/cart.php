<?php ob_start(); ?>

<!-- Section Panier-->
<div id="" class="container d-flex">
  <section>
    <table id="tableCart" class="table table-striped">
      <thead>
        <tr class="text-center">
          <th>Image</th>
          <th class="col-md-3">Menu</th>
          <th class="col-md-3">Chef</th>
          <th class="col-md-1">Prix</th>
          <th class="col-sm-1">Quantité</th>
          <th>Actions</th>
        </tr>
      </thead>

      <tbody id="tabCart">
      <?php
      $total = 0;
      if(!isset($_SESSION['cart'])){
        $emptyCart = 'Votre panier est vide';
      }else{
        foreach($_SESSION['cart'] as $cart){
          $total += $cart['price'];
      ?>
        <tr class="text-center">
          <td><img src="./assets/pictures/<?=$cart['picture_meal']?>" alt="..." width="90px"></td>
          <td><?=$cart['name_meal']?></td>
          <td>by <?=$cart['name_chef']?></td>
          <td><?=$cart['price']?>€</td>
          <td><input type="number" id="quant" name="quant" class="form-control" min="1" value="1" max="10"></td>
          <td  class="text-center"><a class="btn" id="deleteCartItem" href="index.php?action=updateCart&id=<?=$cart['id_meal']?>"onclick="return confirm('Etes vous sûr de vouloir supprimer')"><i class="fas fa-trash"></i></a></td>
        </tr>
      <?php }} ?>
      </tbody>
    </table>
<!-- Message panier vide --> 
    <?php if(isset($emptyCart)){?>
      <div class="alert alert-danger text-center"><?=$emptyCart?></div>
    <?php } ?>
<!-- Bouton retour shop-->   
    <a class="btn" id="returnShop" href="index.php?action=shop"><i class="fas fa-undo-alt" style="color:rgb(174,140,95);" aria-hidden="true"></i> Continuez vos achats</a>
  </section>

<!-- Section frais livraison, total et paiement-->
  <section class="mt-5 mb-3">
    <div id="validation" class="ml-5 border p-3 mt-5">
<!-- Messafe Menu déjà ajouté au panier-->  
    <?php if(isset($alreadyAdd)){?>
      <div class="alert alert-danger text-center"><?=$alreadyAdd?></div>
    <?php } ?>
      <form>
        <label class="" for="date">Date de livraison souhaitée*</label>
        <input type="date" id="date" class="form-control mb-2">
        <label for="totalMenu" id="totalMenu" >Prix total menu</label>
        <input type="text"id="totalMenu" class="form-control mb-2" value="<?=$total?>" readonly>
        <label for="livraison" id="livraison">Livraison</label>
        <input type="text"id="livraison" class="form-control mb-2" value="8.90" readonly>
        <label for="total" id="total" value="">Prix total commande</label>
        <input type="text"id="total" class="form-control mb-2" value="<?=$total+8.90?>" readonly>
        <label for="email" id="emailValider">Email*</label>
        <input type="email"id="email" class="form-control" placeholder="Veuillez saisir votre email...">

<!-- Input hidden appelés dans la page paiement stripe (voir js stripe)-->
        <input type="hidden" id="ref" value="<?=$cart['id_meal']?>"> 
        <input type="hidden" id="name" value="<?=$cart['name_meal']?>">
        <input type="hidden" id="chef" value="<?=$cart['name_chef']?>">
        <input type="hidden" id="prix" value="<?=$cart['price']?>">

        <button type="button" id="checkout-button" class="btn  col-12 mt-3">Valider ma commande</button>
      </form>
    </div>
  </section>
</div>

<?php $contenu = ob_get_clean();
    require_once("./views/public/templatePublic.php");
?>