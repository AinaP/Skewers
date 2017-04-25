<?php
session_start();
if(isset($_SESSION['user']) && isset($_SESSION['user_type']) && isset($_SESSION['user_id']))
{
  $stat=' <li><a href="profil/mycart">Panier</a></li>
  <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$_SESSION['user'].'<span class="glyphicon glyphicon-user pull-right"></span></a>
        <ul class="dropdown-menu">
          <li><a href="profil/me">Mon compte <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
          <li class="divider"><span class="glyphicon glyphicon-cog pull-right"></span></li>
          <li><a href="disconnect">Déconnexion <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
        </ul>
      </li>';
}
else
{
  $stat = '
  <li><a href="my-account">Se connecter</a></li>
  <li><a href="new-user">S\'inscrire</a></li>
  ';
}

if(isset($_GET['btnSearch']))
{
  $mot = $_GET['recherche'];
  if(!empty($mot))
  {
  $s = "catalog/allproducts?p=".$mot;
  header("Location: ".$s);
  }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>

  <title>Skewers</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="rsc/bootstrap-3.3.7/css/bootstrap.css">
  <link rel="stylesheet" href="rsc/css/cms.css">
  <link rel="stylesheet" href="rsc/css/foot.css">

</head>
<body onresize="">

<nav id="head" class="navbar navbar-default navbar-top">
  <div class="container">
    <div class="navbar-header">

      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <a class="navbar-brand" href="home">Skewers</a>

    </div>

    <div class="collapse navbar-collapse" id="myNavbar">

      <ul class="nav navbar-nav navbar-right">


        <li><a href="catalog/allproducts">Les offres</a></li>


          <?php
          echo $stat;
          ?>
      </ul>
    </div>
  </div>
</nav>

<div id="sh" class="jumbotron text-center">
  <h1>Skewers</h1>
  <p></p>
  <form class="form-inline" method="GET">
    <div class="input-group">
      <input type="text" class="form-control" name="recherche" size="50" placeholder="" required>
      <div class="input-group-btn">
        <button type="submit" name="btnSearch" class="btn btn-danger">Rechercher</button>
      </div>
    </div>
  </form>
</div>

<div id="sld" class="container">
  <br>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

      <div class="item active">
        <img src="rsc/images/default/1.jpg" alt="" class="img-slide">
        <div class="carousel-caption">
          <h3>Nouriture</h3>
          <p>traver de porc au miel.</p>
        </div>
      </div>

      <div class="item">
        <img src="rsc/images/default/2.jpg" alt="" class="img-slide">
        <div class="carousel-caption">
          <h3>nouriture</h3>
          <p>Big burger miam</p>
        </div>
      </div>

      <div class="item">
        <img src="rsc/images/default/3.jpg" alt="" class="img-slide">
        <div class="carousel-caption">
          <h3>Nouriture</h3>
          <p>Du bon poulet BBQ.</p>
        </div>
      </div>

      <div class="item">
        <img src="rsc/images/default/4.jpg" alt="" class="img-slide">
        <div class="carousel-caption">
          <h3>Nouriture</h3>
          <p>Team Brrrrochette</p>
        </div>
      </div>

    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>


<!-- Container (About Section) -->
<div id="vdm" class="container-fluid">
  <center><h2>Les derniers articles</h2></center>
</div>


<!-- <div id="cdp" class="container">
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">Top 1</div>
        <div class="panel-body"><img src="porc.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">traver de porc au miel</div>
      </div>
    </div>


<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">Top 2</div>
        <div class="panel-body">
        <img src="2.jpg" class="img-responsive" style="width:100%" alt="Image">
        </div>
        <div class="panel-footer">Big burger !</div>
      </div>
    </div>




<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">Top 3</div>
        <div class="panel-body"><img src="brochette.jpg" class="img-responsive" style="width:100%" alt="Image">
        </div>
        <div class="panel-footer">brochette</div>
      </div>
    </div>
  </div>
</div>

</div>
</div>
</div>
</div>
-->
<div class = "container">
<?php
	
require_once('rsc/require/index_fonction.php');
echo $donnees;
?>
</div>



  <div id="bb" class="backbot">
    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="right">
    <span class="glyphicon glyphicon-chevron-up"></span></a>
  </div>





      <div class="footer" id="footer">
          <div class="container">
              <div class="row">
                  <div class="col-lg-3  col-md-3 col-sm-4 col-xs-6">
                      <h3> A propos de nous </h3>
                      <ul>
                          <li> <a href="about"> Qui nous sommes </a> </li>


                      </ul>
                  </div>
                  <div class="col-lg-3  col-md-3 col-sm-4 col-xs-6">
                      <h3> Localiser </h3>
                      <ul>
                          <li> 25 Rue de la réussite 75012 </li>


                      </ul>
                  </div>
                  <div class="col-lg-3  col-md-3 col-sm-4 col-xs-6">
                      <h3> Des questions ? </h3>
                      <ul>
                          <li> <a href="#"> contact@skewers.com </a> </li>
                          <li> <a href="#">01 07 07 07 69</a> </li>

                      </ul>
                  </div>

                  <div class="col-lg-3  col-md-3 col-sm-6 col-xs-12 ">


                  </div>
              </div>
              <!--/.row-->
          </div>
          <!--/.container-->
      </div>
      <!--/.footer-->

      <div class="footer-bottom">
          <div class="container">
              <p class="pull-left"> Copyright © Skewers 2017. All right reserved. </p>

          </div>
      </div>


  <script type="text/javascript" src="rsc/js/jquery-2.2.4.min.js"></script>
  <script type="text/javascript" src="rsc/bootstrap-3.3.7/js/bootstrap.js"></script>
  <scipt type="text/javascript" src="rsc/js/fct.js"></script>

</body>
</html>
