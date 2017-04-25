<?php
session_start();
if(isset($_SESSION['user']) && isset($_SESSION['user_type'])&& isset($_SESSION['user_id']))
{
     $id = $_SESSION['user_id']; $produits_panier = array();
     require_once("../../rsc/require/db.php");
     $req = $bdd->prepare("SELECT * FROM panier WHERE id_c = ?");
     $req->execute([$id]);
     $produits_panier = array(); $total = 0;
     while($produits_panier = $req->fetch(PDO::FETCH_ASSOC) )
     {
       $total += $produits_panier['Sous_total'];
     }
     $nb = $req->rowCount();
     $req->closeCursor();

  if($nb>0)
  {
     $insert = $bdd->prepare("INSERT INTO commande SET prix_com = ? , nbr_art_com = ?, statut_com = 'ok' , id_c = ? ");
     $insert->execute([$total,$nb,$id]);
     $insert->closeCursor();

     $delall = $bdd->prepare("DELETE FROM panier WHERE id_c = ?");
     $delall->execute([$id]);
     $delall->closeCursor();
     header("Location: ../mycart");
  }

}
else {
  header("../../my-account");
}
