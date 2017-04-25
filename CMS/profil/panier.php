<?php
session_start();
if(isset($_SESSION['user']) && isset($_SESSIOn['user_type']) && isset($_SESSION['user_id']) )
{

}
else
{
header("../my-account");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>

  <title>Skewer</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../rsc/bootstrap-3.3.7/css/bootstrap.css">
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
          <li><a href="#">Panier</a></li>
          <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['user']; ?><span class="glyphicon glyphicon-user pull-right"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="me">Mon compte <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                  <li class="divider"><span class="glyphicon glyphicon-cog pull-right"></span></li>
                  <li><a href="../disconnect">Déconnexion <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                </ul>
              </li>

        </ul>
      </div>
    </div>
  </nav>


<div class="jumbotron text-center">
  <h1>Votre Panier</h1>

</div>

<div class="container">
  <table id="cart" class="table table-hover table-condensed">
    <thead>
      <tr>
        <th style="width:50%">Produits</th>
        <th style="width:10%">Prix €</th>
        <th style="width:8%">Quantité</th>
        <th style="width:22%" class="text-center">Sous total €</th>
        <th style="width:10%"></th>
      </tr>
    </thead>

        <tbody>
        <?php require_once("../rsc/require/panier_fonctions.php"); ?>
      </tbody>

          <tfoot>
            <tr class="visible-xs">
              <td class="text-center"><strong>--,--€</strong></td>
            </tr>
            <tr>
              <td><a href="../catalog/allproducts" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continuer Mes Achats</a></td>
              <td colspan="2" class="hidden-xs"></td>
              <td class="hidden-xs text-center"><strong>Total <?php echo $total ;?>€</strong></td>
              <td><a href="panier/confirm.php" class="btn btn-success btn-block">Confirmer <i class="fa fa-angle-right"></i></a></td>
            </tr>
          </tfoot>
        </table>
</div>







<script type="text/javascript" src="../rsc/js/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="../rsc/bootstrap-3.3.7/js/bootstrap.js"></script>

</body>
</html>
