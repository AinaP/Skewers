<?php
session_start();
if(!isset($_SESSION['user']) && !isset($_SESSION['user_type']) && !isset($_SESSION['user_id']) )
{
   header("Location: ../../home");
}
else
{
  if($_SERVER['REQUEST_METHOD']!="POST")
  {
    echo "Une erreur est survenue,merci de réessayer !";
  }
  else {
    require_once("../../rsc/require/db.php");
    $produit = array(); $produits_liste = "";
    $action = $_POST['action']; // id du produit
    if(empty($action))
    {
      echo "Vide";
    }
    else
    {
      # code...
     $id_c = $_SESSION['user_id'];
     $req = $bdd->prepare("SELECT * FROM panier WHERE id_c = ?");
     $req->execute([$id_c]);
     $result = $req->fetch(PDO::FETCH_ASSOC);
     $nb = $req->rowCount();
     $req->closeCursor();


      if($nb >0) // si le produit existe , on le met dans le panier
      {
         echo $nb;
      }
      else
      {
       echo "Vide";
      }
    }

  }
}
