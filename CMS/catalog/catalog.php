<?php
session_start();
 require_once("../rsc/require/db.php");
 require_once("../rsc/require/catalog_functions.php");

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Tous les produits</title>
	<link rel="stylesheet" type="text/css" href="../rsc/css/catalog.css">
	<link href="../rsc/bootstrap-3.3.7/css/bootstrap.css" rel="stylesheet">
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


          <li><a href="#">Les offres</a></li>


            <?php
            echo $stat;
            ?>
        </ul>
      </div>
    </div>
  </nav>


	<div class="jumbotron text-center">
	  <h3>Vous recherchez quelque chose ?</h3>
	  <p></p>


		<form id="formSearch" class="form-inline" method="POST">
	    <div class="input-group">
	      <input type="text" class="form-control"  name="motcle" id="motcle" size="50" placeholder="" required>
	      <div class="input-group-btn">
	        <button id="btnSearch" type="submit" name="btnSearch" class="btn btn-danger">Rechercher</button>
	      </div>
	    </div>

			<select class="form-control" id="sel1">
				<option>Toutes les catégories</option>
			  <?php echo $categorie_liste ; ?>
			</select>
	  </form>

  </div>


  <div class="container">

    <div class="well well-sm">
         <div class="btn-group">

         </div>

        <strong>Affichage</strong>
        <div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list"></span>Liste</a>
						<a href="#" id="grid" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th"></span>Grille</a>

        </div>

				<strong>Trier par</strong>
				<div class="btn-group">
           <select>
           <option>Nom</option>
           <option>Prix croissant</option>
           <option>Prix décroissant</option>
           <option>Date</option>
           </select>
				</div>


    </div>

     <p id="reponse"><?php echo $recherche; ?></p> <!-- résultat de la recherche-->
    <div id="products" class="row list-group">
        <?php
        echo $produits_liste;
        ?>
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
<script type="text/javascript" src="../rsc/js/loadpv.js"></script>
<script type="text/javascript" src="../rsc/bootstrap-3.3.7/js/bootstrap.js"></script>
<script type="text/javascript" src="../rsc/js/catalog.js"></script>
</body>
</html>
