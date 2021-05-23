<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./assets/css/templateAdmin.css">
<link rel="icon" type="image/png" sizes="18x18" href="./assets/pictures/logo2.png">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<!-- Polices personnalisées pour ce modèle -->
<link href = "vendor / font-awesome / css / font-awesome.min.css" rel = "stylesheet" type = "text / css" >
<!-- Plugin au niveau de la page CSS -->
<link href = "vendor / datatables / dataTables.bootstrap4.css" rel = "stylesheet" >
<!-- Styles personnalisés pour ce modèle -->
<link href = "css / sb-admin.css" rel = "stylesheet" >
</head>

</head>
<body>

<div class="sidenav">
  <h1 class="h1Sidenav text-center text-white">Un Chef à la Maison</h4>
  <div class=""><a class="navbar-brand text-center" href="#"><img src="./assets/pictures/logo2.png" width="70px"/></a></div>

  <?php if(isset($_SESSION["Auth"])){ ?>
  <!-- <a href="index.php?action=login"><i class="fas fa-sign-out-alt text-white"></i>Connexion</a> -->
  <h2 class=" h2Sidenav text-white text-center mb-4">Bonjour <?php echo $_SESSION["Auth"]->firstname; ?></h2>
    <a href="index.php?action=logout_admin"><i class="fas fa-key" style="color:rgb(174,140,95);"></i> Déconnexion</a>
  
  
  <button class="dropdown-btn"><i class="fas fa-bread-slice" style="color:rgb(174,140,95);"></i> Chefs
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="index.php?action=add_chef"><i class="fas fa-plus text-white"></i> Ajout</a>
    <a href="index.php?action=list_chefs"><i class="fas fa-list text-white"></i> Liste</a>
  </div>

  <button class="dropdown-btn"><i class="fas fa-utensils" style="color:rgb(174,140,95);"></i> Menus 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="index.php?action=add_meal"><i class="fas fa-plus text-white"></i> Ajout</a>
    <a href="index.php?action=list_meals"><i class="fas fa-list text-white"></i> Liste</a>
  </div>

  <?php if($_SESSION["Auth"]->id_g == 1){?> 

  <button class="dropdown-btn"><i class="fas fa-user-circle" style="color:rgb(174,140,95);"></i> Clients
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="index.php?action=register_client"><i class="fas fa-plus text-white"></i> Ajout</a>
    <a href="index.php?action=list_clients"><i class="fas fa-list text-white"></i> Liste</a>
  </div>
  <button class="dropdown-btn"><i class="fas fa-user-graduate" style="color:rgb(174,140,95);"></i> Grades 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="index.php?action=add_grade"><i class="fas fa-plus text-white"></i> Ajout</a>
    <a href="index.php?action=list_grades"><i class="fas fa-list text-white"></i> Liste</a>
  </div>
  <button class="dropdown-btn"><i class="fas fa-users" style="color:rgb(174,140,95);"></i> Utilisateurs 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="index.php?action=register_user"><i class="fa fa-registered text-white" aria-hidden="true"></i> Inscription</a>
    <a href="index.php?action=list_users"><i class="fa fa-list text-white" aria-hidden="true"></i> Liste</a>
  </div>
  <?php }} ?>
  <a href="index.php?action=transferShop" style="font-size: 15px;"><i class="fas fa-undo-alt" style="color:rgb(174,140,95);" aria-hidden="true"></i> Retour à la boutique</a>
  
</div>
<div class="container mt-5">
    <div class="main">
        <h1 id="titreAdmin" class="text-center" style="border-radius: 30px; color:rgb(174,140,95); background-color:rgb(3, 3, 29);">ADMINISTRATION</h1>

        <?= $contenu; ?>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="./assets/js/templateAdmin.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html> 