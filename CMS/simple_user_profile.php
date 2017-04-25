<?php
session_start();

require_once('rsc/require/db.php');

if (!isset($_SESSION['user'])) /* Vérification connexion */
{
	echo "Veuillez vous connecter"."<p>"."<a href="."connect_form.html".">Connexion</a>"."</p>";
}
else
{
	echo "<p>"."Bonjour" ." ". $_SESSION['user']."</p>";
	echo "<p>"."<a href="."disconnect.php".">Deconnexion</a>"."</p>";


	/* Interrogation de la base pour trouver le client à afficher sur la page */

	$req = $bdd->prepare('SELECT * FROM client WHERE  mail=?'); /* On cherche dans la table client si l'adresse mail match */
	$req->execute([$_SESSION['mail']]);
	$res = $req->fetch(PDO::FETCH_ASSOC);
	$req->closeCursor();

	if ($res)
	{
		/* Si on trouve, on met les résultats dans des variables */
		$address = $res['address'];
		$ville = $res['ville'];
		$postalCode = $res['code_postal'];
		$nom = $res['nom'];
		$prenom = $res['prenom'];
		$mail = $res['mail'];
		$id = $res['id_c'];
	}

			/* Si on trouve, on met les résultats dans des variables */



}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Simple User Profile  - Bootsnipp.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->

	<link rel="stylesheet" href="style_user.css" type="text/css" media="screen">

    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >


          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $prenom . " " . $nom?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" class="img-circle img-responsive"> </div>

                <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                  <dl>
                    <dt>DEPARTMENT:</dt>
                    <dd>Administrator</dd>
                    <dt>HIRE DATE</dt>
                    <dd>11/12/2013</dd>
                    <dt>DATE OF BIRTH</dt>
                       <dd>11/12/2013</dd>
                    <dt>GENDER</dt>
                    <dd>Male</dd>
                  </dl>
                </div>-->
                <div class=" col-md-9 col-lg-9 ">
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Adresse:</td>
                        <td><?php echo $address;?></td>
                      </tr>
                      <tr>
                        <td>Ville:</td>
                        <td><?php echo $ville;?></td>
                      </tr>
                      <tr>
                        <td>Code Postal:</td>
                        <td><?php echo $postalCode;?></td>
                      </tr>
                      <tr>
                        <td>Nom:</td>
                        <td><?php echo $nom;?></td>
                      </tr>
                      <tr>
                        <td>Prénom:</td>
                        <td><?php echo $prenom;?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><a href="<?php echo $mail;?>"><?php echo $mail;?></a></td>
                      </tr>

                      </tr>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
                 <div class="panel-footer">
                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right">
                            <a href="edit_user.php?id=<?php echo $id;?>" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>

                        </span>
                    </div>

          </div>
        </div>
      </div>
    </div>
<script type="text/javascript">
$(document).ready(function() {
    var panels = $('.user-infos');
    var panelsButton = $('.dropdown-user');
    panels.hide();

    //Click dropdown
    panelsButton.click(function() {
        //get data-for attribute
        var dataFor = $(this).attr('data-for');
        var idFor = $(dataFor);

        //current button
        var currentButton = $(this);
        idFor.slideToggle(400, function() {
            //Completed slidetoggle
            if(idFor.is(':visible'))
            {
                currentButton.html('<i class="glyphicon glyphicon-chevron-up text-muted"></i>');
            }
            else
            {
                currentButton.html('<i class="glyphicon glyphicon-chevron-down text-muted"></i>');
            }
        })
    });


    $('[data-toggle="tooltip"]').tooltip();

    $('button').click(function(e) {
        e.preventDefault();
        alert("This is a demo.\n :-)");
    });
});
</script>
</body>
</html>
