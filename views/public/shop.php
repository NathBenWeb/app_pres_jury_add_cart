<?php ob_start(); ?>

<div id="containerShop" class="container">
  <div class="row">
    <div class="col-12 d-flex">
<!---------------------------- search----------------------------------->
      <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="input-group">
        <input id="search"  class="form-control search " type="search" name="search" placeholder="Recherchez...">
        <button id="btnSearch" type="submit" class="btn btn-outline-secondary " name="soumis"><i class="fas fa-search"></i></button>
      </form>
<!---------------------------- bouton toggle recherche par chef----------------------------------->
      <button id="buttonChefs" class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Les menus de vos chefs</button>
      <ul id="listChefs" class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
      <?php foreach($tabChef as $chef){ ?>
        <li><a class="dropdown-item" href="index.php?action=shop&id=<?=$chef -> getId_chef();?>"><?=$chef->getName_chef();?></a></li>
      <?php } ?>
      </ul>
    </div>
  </div>

<!------------------------------Cards Meals--------------------------------------------------->
  <?php foreach($meals as $meal){?>
  <div id="cardAccueil" class="card mb-3" >
  
    
    <div class="row g-0 ">
      <div id="imgMeal" class="col-md-5">
        <img src="./assets/pictures/<?=$meal->getPicture_meal();?>" alt="..." width="500px" height="200px">
        <h1 id="titreCardAccueil" class="card-title ml-2 mt-2"><?=$meal->getName_meal();?> by <?=strtoupper($meal->getChef()->getName_chef());?><span class="ml-2"><?=$meal->getPrice()." €";?><span></h1>  
      </div>
      <div class="col-lg-5">
        <div id="cardBody" class="card-body">
          <p class="titrePlat ">Pour commencer : </p>
          <p class="card-text" id="start" style=""><?=substr($meal->getStart(), 0, 350);?></p>
          <p class="titrePlat">Pour suivre : </p>
          <p class="card-text" id="dish" style=""><?=substr($meal->getDish(), 0, 350);?></p>
          <p class="titrePlat">Et pour finir : </p>
          <p class="card-text" id="dessert" style=""><?=substr($meal->getDessert(), 0, 350);?></p>
          
          <!-- Validate form -->
          <form action="index.php?action=checkout" method="post">
            <button id="addCart" name="envoi" type="submit" class="btn">Ajouter au panier</button>
            <input type="hidden" name="id_meal" value="<?=$meal->getId_meal();?>">
            <input type="hidden" name="name_meal" value="<?=$meal->getName_meal();?>">
            <input type="hidden" name="name_chef" value="<?=$meal->getChef()->getName_chef();?>">
            <input type="hidden" name="picture_meal" value="<?=$meal->getPicture_meal();?>">
            <input type="hidden" name="price" value="<?=$meal->getPrice();?>">
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
</div>

<?php $contenu = ob_get_clean();
    require_once("./views/public/templatePublic.php");
?>