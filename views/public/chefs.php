<?php ob_start();?>

<div id="containerChef" class="container">
  <div class="row"> 
    <div class="col-12 d-flex">
<!---------------------------- search----------------------------------->
      <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="input-group">
        <input id="searchMeal"  class="form-control search " type="search" name="search" placeholder="Recherchez...">
        <button id="btnSearchMeal" type="submit" class="btn btn-outline-secondary " name="soumis"><i class="fas fa-search"></i></button>
      </form>
<!---------------------------- bouton toggle recherche par chef----------------------------------->
      <button id="buttonMeals" class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Les menus de vos chefs</button>
      <ul id="listChefsMeals" class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
      <?php foreach($tabChef2 as $chef){ ?>
        <li><a class="dropdown-item" href="index.php?action=shop&id=<?=$chef -> getId_chef();?>"><?=$chef->getName_chef();?></a></li>
      <?php } ?>
      </ul>
    </div>
  </div>
<!------------------------------Cards Chefs--------------------------------------------------->
  <h1 id="titreChef">Portrait de vos chefs préférés</h1>
  <?php foreach($tabChef2 as $chef){?>
  <div id="cardChefs" class="card mb-3" style="max-width: 1140px;">
    
  <div class="row g-0">
      <div id="imgChef" class="col-md-2">
        <img src="./assets/pictures/<?=$chef->getPicture_chef();?>" class="" height="180px" width="200px" alt="...">
      </div>
      <div class="col-md-9 ml-4">
        <div class="card-body">
          <h2 id="nameChefs" class=""><?=$chef->getName_chef();?></h2>
          <p id="textChef" class="card-text"><i>« En cuisine, il n'y a pas de créativité sans fondamentaux »</i><br/>D’un père basque et d’une mère Ardenaise, Philippe Etchebest est né le 2 décembre 1966 à Soissons (Aisne). La famille parcourt la France au grè des postes de son père Chef cuisinier : la Ferté-millon, Hendaye, Laon, Orléans, Revin, Haybes pour descendre à Villeuneuve-sur-Lot en 1977. Le couple pose ensuite ses valises à Bordeaux en 1979. Ils reprennent un restaurant basque cours de l’Yser, «le Chipiron», près du marché des Capucins.</p></p>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
</div>

<?php $contenu = ob_get_clean();
    require_once("./views/public/templatePublic.php");
?>