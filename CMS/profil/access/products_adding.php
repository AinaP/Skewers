<?php
session_start();
if(isset($_SESSION['user']) && isset($_SESSION['user_type']) && isset($_SESSION['user_id']))
{

  if($_SERVER['REQUEST_METHOD']==='POST' && $_SESSION['user_type']==="customer")
  {
  $name = htmlspecialchars($_POST['productName']);
  $price = htmlspecialchars($_POST['productPrice']);
  $category = htmlspecialchars($_POST['productCategory']);
  $description = htmlspecialchars($_POST['productDesc']);

  $target_dir = "../../rsc/images/products/p/";
   if(!empty($_FILES))
   {
    $target_file = $target_dir . basename($_FILES["imageDesc"]['name']);
    $uploadOK = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
   }
   else {
    $uploadOK = 0;
   }


      if(!empty($name) && !empty($category)  && !empty($price) && !empty($description)   )
      {
      require_once("../../rsc/require/db.php");
      $myid = $_SESSION['user_id'];
      $insert = $bdd->prepare("INSERT INTO produit SET Nom_produit = ? , prix_p = ? ,description = ? ,id_cat =  ?, id_c = ?" );
      $insert ->execute([$name,$price,$description,$category,$myid]);
      $insert->closeCursor();
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
header("Location: ../../my-account");  # code...
}
