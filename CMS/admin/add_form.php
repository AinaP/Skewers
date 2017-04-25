<?php

/* Vérification si l'utilisateur est connecté */

session_start();
$res = array();
$categorie = array();
$select = "";
if (!isset($_SESSION['prenom']))
{
	echo "Veuillez vous connecter"."<p>"."<a href="."connect_form.html".">Connexion</a>"."</p>";
}
else
{
	echo "Bonjour" ." ". $_SESSION['prenom'];

	/* Connexion à la base de données */
	try
	{
		$bdd=new PDO('mysql:host=localhost;dbname=CMS_WebVP;charset=utf8','root','root'); //conexion à la base
	}
	catch (Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	/* On récupère le nom des catégories */
	$req = $bdd->prepare('SELECT * FROM categorie');
	$req->execute();
	$res = $req->fetch(PDO::FETCH_ASSOC);
	while($res)
	{
		$select .= '<option' . ' value=' . $res['id_cat'] . '>' . $res['nom_cat'] . '</option>';
		$res = $req->fetch(PDO::FETCH_ASSOC);

	}
	$count = $req->rowCount();
	$req->closeCursor();
	var_dump($res);
	/* On met le résultat des catégories dans un tableau */


	if (isset($_SESSION['OK']))
	{
		echo "<br />" . $_SESSION['OK'];
	}
}
?>

<!DOCTYPE html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>add_form</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<!-- Custom CSS -->

	<link rel="stylesheet" href="style.css" type="text/css" media="screen">

</head>
<body>
	<div class="container">
		<div class="col-sm-8 col-sm-offset-2 background-form margin-form padding-form">
			<form action="add_form_submit.php?id=<?php echo $_SESSION['id_user']?>" method="post" enctype="multipart/form-data" id="addForm">
			  <div id="name">
			  	<center><p><b>Ajouter un produit</b></p></center>
			  </div>
			  <div class="form-group">
			    <label for="productName">Nom du produit</label>
			    <input type="text" class="form-control" id="productName" placeholder="Le nom de votre produit" name="productName">
			  </div>
			  <div class="form-group">
			    <label for="productPrice">Prix en Euros</label>
			    <input type="number" step="0.01" class="form-control" id="productPrice" placeholder="prix du produit en euros" name="productPrice" >
			  </div>
			  <div class="form-group">
			    <label for="productStock">Stock</label>
			    <input type="number" class="form-control" id="productStock" placeholder="Mettre en stock" name="productStock">
			  </div>
			  <div class="form-group">
			    <label for="productDesc">Description</label>
			    <textarea class="form-control" name="productDesc" form="addForm">Décrivez votre produit</textarea>
			  </div>
			  <div class="form-group">
			     <label for="productCategory">Catégorie</label>
			     <select class="form-control" id="productCategory" name="productCategory">
			       <?php
				   echo $select;
			       ?>
			     </select>
			   </div>
			   <div class="form-group">
				   <label for="filetoUpload">Image descriptive</label>
				   <input type="file" accept="image/*" name="imageDesc" id="fileToUpload">
			   </div>
			  	<div class="container col-md-2 col-md-offset-5">
			  		<button type="submit" class="btn btn-primary" name="submit" >Ajouter</button>
				</div>
			</form>
		</div>
	</div>
	<div class="container-fluid">
	</div>
</body>
