<?php
session_start();
if(isset($_SESSION['user']) && isset($_SESSION['user-type']) )
{

  if($_SERVER['REQUEST_METHOD']==='POST' && $_SESSION['user-type']==="seller")
  {
  $name = htmlspecialchars($_POST['productName']);
  $price = htmlspecialchars($_POST['productPrice']);
  $stock = htmlspecialchars($_POST['productStock']);
  $category = htmlspecialchars($_POST['productCategory']);
  $description = htmlspecialchars($_POST['productDesc']);
  $id_vendeur = $_GET['id'];

  $target_dir = "../images/products/";
   if(!empty($_FILES))
   {
    $target_file = $target_dir . basename($_FILES["imageDesc"]['name']);
    $uploadOK = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
   }
   else {
    $uploadOK = 0;
   }


      if(!empty($nom_produit) && !empty($cat) && !empty($quantity) && !empty($prix) && !empty($ht) && !empty($ttc) )
      {
      require_once("../../rsc/require/db.php");
      $insert = $bdd->prepare("INSERT INTO produit WHERE ");
      echo "Votre produit a été correctement ajouté !";

      }

      else
      {
      echo "Merci de compléter tous les champs !";
      }

  }
// fin si la method est en mode post
// la methid utlisé n'est pas post alors on va au else
else {echo "Opération refusée par le serveur ! Vérifier que vous êtes connecté(e) ";}

}

// on n'est pas connecté
else
{
header("Location: ../../login.php");  # code...
}
