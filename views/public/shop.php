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
  <div class="container">
    <div class="card mb-3" id="cardAccueil">
      <div class="row g-0">
        <div class="col-md-4 align-self-center ml-3">
          <img class="" src="./assets/pictures/<?=$meal->getPicture_meal();?>" alt="..." width="100%"  class="p-2" id="imgMeal">
        </div>
        <div class="col-md-7 ml-3">
          <div class="card-body">
            <h1 id="titreCardAccueil" class="card-title"><?=$meal->getName_meal();?> by <?=strtoupper($meal->getChef()->getName_chef());?><span class="ml-2"><?=$meal->getPrice();?><span></h1>
            <p class="card-text"><span>Pour commencer : </span><?=substr($meal->getStart(), 0, 350);?></p>
            <p class="card-text"><span>Pour suivre : </span><?=substr($meal->getDish(), 0, 350);?></p>
            <p class="card-text"><span>Et pour finir : </span><?=substr($meal->getDessert(), 0, 350);?></p>
            <form action="index.php?action=cart" method="post">
                <button onclick="popupCart()" id="addCart" name="envoi" type="submit" class="btn">Ajouter au panier</button>
                <div id="snackbar">Ajouté au panier !</div>
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
  </div>
<?php } ?>

<?php $contenu = ob_get_clean();
    require_once("./views/public/templatePublic.php");
?>