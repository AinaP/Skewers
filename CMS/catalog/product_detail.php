<?php
session_start();
if(isset($_SESSION['user']) && isset($_SESSION['user_type']) && isset($_SESSION['user_id']))
{
  $stat=' <li><a href="../profil/mycart">Panier</a></li>
  <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$_SESSION['user'].'<span class="glyphicon glyphicon-user pull-right"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../profil/me">Mon compte <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
          <li class="divider"><span class="glyphicon glyphicon-cog pull-right"></span></li>
          <li><a href="../disconnect">Déconnexion <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
        </ul>
      </li>';
}
else
{
  $stat = '  <li><a href="../login.php">Se connecter</a></li>
    <li><a href="../signup.php">S\'inscrire</a></li>';
}

$p =""; $nom_produit =""; $image = ""; $prix =""; $description ="";
if(!empty($_GET) )
{
  if(!isset($_GET['p'])){
    header("Location : ../catalog/allproducts");
  }

  else
  {
  $p = $_GET['p'];
  require_once("../rsc/require/db.php");
  $req = $bdd->prepare("SELECT * FROM produit WHERE id_p = ?");
  $req->execute([$p]);
  $res = array();
  $res = $req->fetch(PDO::FETCH_ASSOC);
  $req->closeCursor();
  if($res)
  {
    $nom_produit =$res['Nom_produit'];
     $image = $res["image"];
     $prix =$res["prix_p"];
     $description = $res["description"];
  }
  else {
    header("Location: ../catalog/allproducts");
  }


  }
}
else {
  header("Location :../catalog/allproducts");
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Produit</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

  	<link href="../rsc/bootstrap-3.3.7/css/bootstrap.css" rel="stylesheet">
  	  <link rel="stylesheet" href="../rsc/css/product_detail.css">
      <link rel="stylesheet" href="../rsc/css/cms.css">
      <link rel="stylesheet" href="../rsc/css/foot.css">
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


            <li><a href="allproducts">Les offres</a></li>


              <?php
              echo $stat;
              ?>
          </ul>
        </div>
      </div>
    </nav>


	<div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">

						<div class="preview-pic tab-content">
						  <div class="tab-pane active" id="pic-1"><img src="../rsc/images/p/<?php echo $image?>"/></div>
						  <div class="tab-pane" id="pic-2"><img src="http://placekitten.com/400/252" /></div>
						  <div class="tab-pane" id="pic-3"><img src="http://placekitten.com/400/252" /></div>
						  <div class="tab-pane" id="pic-4"><img src="http://placekitten.com/400/252" /></div>
						  <div class="tab-pane" id="pic-5"><img src="http://placekitten.com/400/252" /></div>
						</div>
						<ul class="preview-thumbnail nav nav-tabs">
						  <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
						  <li><a data-target="#pic-2" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
						  <li><a data-target="#pic-3" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
						  <li><a data-target="#pic-4" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
						  <li><a data-target="#pic-5" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
						</ul>

					</div>
					<div class="details col-md-6">
						<h3 class="product-title"><?php  echo  $nom_produit?></h3>
						<p class="product-description"><?php echo   $description; ?></p>
						<h4 class="price">Prix: <span><?php echo   $prix . "€"?></span></h4>
						<div class="action">
							<button id="<?php echo  $p;?>" class="add-to-cart btn btn-default panier" type="button">Ajouter au panier</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



  <div id="msg" class="modal fade" id="myModal" role="dialog">
      <div id="md" class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Message</h4>
          </div>
          <div class="modal-body">
            <p id="modal_msg">Some text in the modal.</p>
          </div>
          <div class="modal-footer">
            <button id="fermer" type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
          </div>
        </div>

      </div>
    </div>


  <?php //---------------------------------------------------------------------------------------------------------------------- ?>
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



<script type="text/javascript" src="../rsc/js/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="../rsc/bootstrap-3.3.7/js/bootstrap.js"></script>
<script type="text/javascript" src="../rsc/js/product_detail.js"></script>
</body>
</html>
