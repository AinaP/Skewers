<?php
session_start();
if(isset($_SESSION['user']) && isset($_SESSION['user_type']) && isset($_SESSION['user_id']))
{
  $id = $_SESSION['user_id'];
  $stat=' <li><a href="mycart">Panier</a></li>
  <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$_SESSION['user'].'<span class="glyphicon glyphicon-user pull-right"></span></a>
        <ul class="dropdown-menu">
          <li><a href="me">Mon compte <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
          <li class="divider"><span class="glyphicon glyphicon-cog pull-right"></span></li>
          <li><a href="../disconnect">Déconnexion <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
        </ul>
      </li>';
      require_once("../rsc/require/db.php");
      require_once("../rsc/require/profil_fonctions.php");
}
else {
  header("../my-account");
}
 ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Profil</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../rsc/bootstrap-3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="../rsc/css/profil.css">
  <link rel="stylesheet" href="../rsc/css/cms.css">


</head>
<body>

  <nav id="head" class="navbar navbar-default navbar-top">
    <div class="container">
      <div class="navbar-header">

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <a class="navbar-brand" href="../home">Skewers</a>

      </div>

      <div class="collapse navbar-collapse" id="myNavbar">

        <ul class="nav navbar-nav navbar-right">


          <li><a href="../catalog/allproducts">Les offres</a></li>

            <?php
            echo $stat;
            ?>
        </ul>
      </div>
    </div>
  </nav>


<div class="container">
  <h2>Profil</h2>
  <p></p>
  <ul class="nav nav-pills">
    <li id="mesachats"><a data-toggle="pill" href="#achats">Achats</a></li>
    <li id="mesinfos"><a data-toggle="pill" href="#infos">Infos</a></li>
    <li id="mesproduits"><a data-toggle="pill" href="#produits">Mes produits</a></li>


  </ul>

  <div class="tab-content">

    <div id="achats" class="tab-pane fade">
      <h3>Achats</h3>
      <table class="table table-striped table-hover ">
        <thead>
          <tr>
            <th>Numéro de commande</th>
            <th>Nombre d'articles</th>
            <th>Prix</th>
            <th>Statut</th>

          </tr>
        </thead>
        <tbody>
        <?php echo $achat_liste ;?>
        </tbody>
      </table>
    </div>


    <div id="infos" class="tab-pane fade">
      <?php

      echo $info_liste ;
      ?>

    </div>


    <div id="produits" class="tab-pane fade">
      <h3>Mes produits</h3>
      <a class="btn btn-success" href="access/add.php">Ajouter un produit</a>
      <table class="table table-striped table-hover ">
        <thead>
          <tr>
            <th>Image</th>
            <th>Nom </th>
            <th>Catégorie</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Date d'achat</th>
          </tr>
        </thead>
        <tbody>
          <?php echo $mp_liste ; ?>
        </tbody>
      </table>
    </div>


  </div>
</div>

<script type="text/javascript" src="../rsc/js/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="../rsc/bootstrap-3.3.7/js/bootstrap.js"></script>
<script type="text/javascript" src="../rsc/js/profil.js"></script>
</body>
</html>
