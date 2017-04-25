<?php
session_start();
$errors = array();
$res = "";

/* Stockage des valeurs du form dans des variables */
$name = htmlspecialchars($_POST['productName']);
$price = htmlspecialchars($_POST['productPrice']);
$stock = htmlspecialchars($_POST['productStock']);
$category = htmlspecialchars($_POST['productCategory']);
$description = htmlspecialchars($_POST['productDesc']);
$id_vendeur = $_GET['id'];

/* Variables pour l'upload de fichiers */

$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["imageDesc"]['name']);
$uploadOK = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);


/* 

var_dump($name);
var_dump($price);
var_dump($stock);
var_dump($category);

*/

if (!isset($_SESSION['prenom'])) /* Vérification connexion */
{
	echo "Veuillez vous connecter"."<p>"."<a href="."connect_form.html".">Connexion</a>"."</p>";
}
else
{	
	if (isset($_POST['submit']))
	{
		if (!empty($name) && !empty($price) && !empty($stock) && !empty($category)) /* Vérification des champs remplis */
		{	
			
			
			/* Détermination du statut "En stock" ou "Epuisé"*/
			if ($stock > 0)
			{
				$statut = 1; /* En stock */
			}
			else
			{
				$statut = 0; /* Epuisé */
			}
		
			/* Connexion à la base de données */
			try 
			{
				$bdd=new PDO('mysql:host=localhost;dbname=CMS_WebVP;charset=utf8','root','root'); //conexion à la base
			} 
			catch (Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}
			
			/* Insertion dans la table produit */
			
			$req = $bdd->prepare('INSERT INTO produit SET Nom_produit=?, Description=?, prix_p=?, Stock=?, Statut=?, id_cat=?');
			$req->execute(array(
			
				$name,
				
				$description,
				
				$price,
				
				$stock,
				
				$statut,
				
				$category,
			));
			$req->closecursor();
			
			/* Récupération de l'ID du produit nécéssaire pour l'image */
			
			$req = $bdd->prepare('SELECT id_p FROM produit WHERE  Nom_produit=?');
			$req->execute([$name]);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			$req->closecursor();
			//var_dump($res);
			
			/* T R A I T E M E N T  U P L O A D  I M A G E */
			
			/* Vérification si c'est bien une image */
			if ($imageFileType != "jpg" and $imageFileType != "png" and $imageFileType != "jpeg" and $imageFileType != "gif")
			{
				$errors['imageType'] = "Mauvais format de fichier, uploadez seulement JPG, JPEG, PNG, GIF";
				$uploadOK = 0;
			}
			
			// Check if file already exists
			if (file_exists($target_file)) {
			    echo "Sorry, file already exists.";
			    $uploadOk = 0;
			}
			// Check file size
			if ($_FILES["imageDesc"]["size"] > 6000000) {
			    echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			
			/* Rename du file */
			$temp = explode(".", $_FILES["imageDesc"]["name"]);
			$newfilename =  $res['id_p'] . '.' . end($temp);
			
			/* Upload */
			if($uploadOK != 0)	
			{
				move_uploaded_file($_FILES["imageDesc"]["tmp_name"], "images/" . $newfilename);
			
				$_SESSION['OK'] = "Le traitement a bien été effectué";
				header('Location: add_form.php'); // Redirection vers la page Ajouter un produit
			}
			else
			{
				$errors['uploadError'] = "ERREUR D'UPLOAD";
			}
		
		}
		else
		{
			$errors['empty'] = "Un des champs est vide"; /* Stockage dans un tableau des erreurs */
		}
		
	}
	else
	{
		$errors['problem'] = "ERREUR FATALE";
	}
	
	
}

/* INSERTION DANS LA TABLE D'ASSOCIATION VEND */

$req = $bdd->prepare('INSERT INTO vend SET id_p=?, id_v=?');
$req->execute(array(

$res['id_p'],

$id_vendeur,
));
$req->closecursor();
	
	/* Affichage des erreurs */
	
if ($errors)
{
	foreach($errors as $num_errors)
	{
		echo $num_errors . '<br /><a href="add_form.php">Retour</a>'; 
			}
		}	


?>