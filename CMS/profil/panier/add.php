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

  else
  {
    require_once("../../rsc/require/db.php");
    $produit = array(); $produits_liste = "";
    $idp = $_POST['idp']; // id du produit
    if(empty($idp))
    {
      echo "Aucun produit sélectionné !";
    }

    // on a sélectionné un produit alors ...
    else
    {
      # code...
     $id_c = $_SESSION['user_id'];
     // on vérifie si le produit existe dans la table produit, on ne vas pas ajouter au panier un produit non existant
     $req = $bdd->prepare("SELECT * FROM produit WHERE id_p = ?");
     $req->execute([$idp]);
     $result = $req->fetch(PDO::FETCH_ASSOC);
     $req->closeCursor();

      if($result) // si le produit existe , on le met dans le panier
      {
      // vérifions si le produit est déjà dans le panier,si oui , on incrémente son nombre dans la base de donnée
        $produits_panier = array();
        $count_produit = $bdd->prepare("SELECT * FROM panier WHERE id_p = ?");
        $count_produit->execute([$idp]);
        $nb = $count_produit->rowCount();
        $produits_panier = $count_produit->fetch(PDO::FETCH_ASSOC);
        $prix_produit = $result['prix_p']; // le prix d'u produit
         // le prix total d'un produit dans le panier
        $count_produit->closeCursor();

        // si il y en a, alors on met à jour le nb de produit dans notre bdd
        if($nb >0 )
        {
          $SousTotal = $produits_panier['Sous_total'];
          $update = $bdd->prepare("UPDATE panier SET Nb_du_produit = ?,Sous_total = ? WHERE id_p = ?");
          $new_nb = $nb+1;
          $SousTotal += $prix_produit;
          $update->execute([$new_nb,$SousTotal,$idp]);
          $update->closeCursor();
          echo "Le produit a été ajouté dans votre panier !";
        }

        else
        {
          $nb++;
          $insert = $bdd->prepare("INSERT  INTO panier SET id_p=?, id_c=?, Nb_du_produit=?,Sous_total = ?");
          $insert->execute([$idp,$id_c,$nb,$prix_produit]);
          $insert->closeCursor();
          echo "Le produit a été ajouté dans votre panier !";
          }

       }

      // le produit n'existe pas dans la table produit
      else
      {
      echo "Le produit n'existe pas !";
      }


    }
    // fin de sélection de produit

  }
  // fin de request method = post
}
// fin de si on est connecté
