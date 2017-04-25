<?php
session_start();
if(isset($_SESSION['user']) && isset($_SESSION['user_type']))
{
 if(!empty($_GET))
 {
   if(isset($_GET['l']) && !empty($_GET['l']) )
   {
     $l = $_GET['l'];
     require_once("../../rsc/require/db.php");
     $req = $bdd->prepare("DELETE FROM panier WHERE id_panier = ?");
     $req->execute([$l]);
     $req->closeCursor();
     header("Location: ../mycart");
   }
 }
}
else {
  header("../../my-account");
}
