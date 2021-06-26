<?php ob_start(); ?>
<div class="container">
    <div class="row">
        <div class="col-4 offset-8">
            <form action="<?php $_SERVER["PHP_SELF"];?>" method="post" class="input-group" enctype="multipart/form-data">
                <input class="form-control" type="search" name="search" id="search" placeholder="Rechercher">
                <button id="btn_chefMeals" type="submit" class="btn btn-outline-secondary" name="soumis"><i id="loupe" class="fas fa-search"></i></button>
            </form>
        </div>
    </div>
    <h2 id="listTitle" class="text-center text-decoration-underline mb-4 mt-4">Liste des Commandes</h2>
    <table id="tabList" class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom client</th>
                <th>Prénom client</th>
                <th>Email client</th>
                <th>Montant commande</th>
                <th>Date de commande</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <?php if(is_array($orders)){
                foreach ($orders as  $order) { ?>
                <td><?=$order->getId_order();?></td>
                <td><?=$order->getNom();?></td>
                <td><?=$order->getPrenom()?></td>
                <td><?=$order->getEmail()?></td>
                <td><?=$order->getMontant()?></td>
                <td><?=$order->getDate();?></td>
            </tr>
            <?php }} ?>
        </tbody>
    </table>
  </div>

<?php 
    $contenu = ob_get_clean();
    require_once('./views/admin/templateAdmin.php');
?>
