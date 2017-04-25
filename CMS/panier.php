<?php
session_start();
if(isset($_SESSION['user']) && isset($_SESSIOn['user_type']) )
{
  $afficher = true;
  require_once("rsc/require/db.php");
  $req = $bdd->prepare("SELECT * FROM cart WHERE ");
}
else
{

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>

  <title>Skewer</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="rsc/bootstrap-3.3.7/css/bootstrap.css">
  <link rel="stylesheet" href="rsc/css/cms.css">

</head>
<body>


<nav class="navbar navbar-default navbar-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <a class="navbar-brand" href="index.php">Skewers</a>
    </div>

    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="catalog/allproducts">Acheter</a></li>
        <li><a href="login.php">Vendre</a></li>
        <li><a href="contact.html">Contact</a></li>
        <li><a href="propos.html">A Propos</a></li>

         <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Catégorie<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Musique</a></li>
            <li><a href="#">nouriture</a></li>
            <li><a href="#">sport</a></li>
          </ul>
            <li><a href="panier.php">Panier</a></li>
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
              <th style="width:50%">Produit(s)</th>
              <th style="width:10%">Prix</th>
              <th style="width:8%">Quantité</th>
              <th style="width:22%" class="text-center">Total</th>
              <th style="width:10%"></th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td data-th="Product">
                <div class="row">
                  <div class="col-sm-2 hidden-xs"><img src="http://placehold.it/100x100" alt="..." class="img-responsive"/></div>
                  <div class="col-sm-10">
                    <h4 class="nomargin">Poulet</h4>
                    <p>Du bon poulet BBQ</p>
                  </div>
                </div>
              </td>
              <td data-th="Price">1.99€</td>
              <td data-th="Quantity">
                <input type="number" class="form-control text-center" value="1">
              </td>
              <td data-th="Subtotal" class="text-center">1.99 €</td>
              <td class="actions" data-th="">
                <button class="btn btn-info btn-sm"><i class="fa fa-refresh"><span class="glyphicon glyphicon-refresh"></span></i></button>
                <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"> <span class="glyphicon glyphicon-remove"></i></button>
              </td>
            </tr>
          </tbody>
        </table>
</div>

<div class="container">
  <table id="cart" class="table table-hover table-condensed">
            <thead>
            <tr>
              <th style="width:50%"></th>
              <th style="width:10%"></th>
              <th style="width:8%"></th>
              <th style="width:22%" class="text-center"></th>
              <th style="width:10%"></th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td data-th="Product">
                <div class="row">
                  <div class="col-sm-2 hidden-xs"><img src="http://placehold.it/100x100" alt="..." class="img-responsive"/></div>
                  <div class="col-sm-10">
                    <h4 class="nomargin">Brochette</h4>
                    <p>Team Brrrrochette</p>
                  </div>
                </div>
              </td>
              <td data-th="Price">3.50€</td>
              <td data-th="Quantity">
                <input type="number" class="form-control text-center" value="1">
              </td>
              <td data-th="Subtotal" class="text-center">3.50 €</td>
              <td class="actions" data-th="">
                <button class="btn btn-info btn-sm"><i class="fa fa-refresh"><span class="glyphicon glyphicon-refresh"></span></i></button>
                <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"> <span class="glyphicon glyphicon-remove"></i></button>
              </td>
            </tr>
          </tbody>

          <tfoot>
            <tr class="visible-xs">
              <td class="text-center"><strong>--,--€</strong></td>
            </tr>
            <tr>
              <td><a href="catalog/allproducts" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continuer Mes Achats</a></td>
              <td colspan="2" class="hidden-xs"></td>
              <td class="hidden-xs text-center"><strong>Total 5.49 €</strong></td>
              <td><a href="error.php" class="btn btn-success btn-block">Confirmer <i class="fa fa-angle-right"></i></a></td>
            </tr>
          </tfoot>
        </table>
</div>

</table>
</form>

<script type="text/javascript" src="rsc/js/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="rsc/bootstrap-3.3.7/js/bootstrap.js"></script>

</body>
</html>
