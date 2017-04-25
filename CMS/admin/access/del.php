<?php
session_start();
if(isset($_SESSION['user']) && isset($_SESSION['user_type']) && isset($_SESSION['user_id']))
{
  $usertype = $_SESSION['user_type'];
 if(!empty($_GET) && $user_type ==="admin")
 {
   if(isset($_GET['l']) && !empty($_GET['l']) )
   {
     $l = $_GET['l'];
     require_once("../../rsc/require/db.php");
     $req = $bdd->prepare("DELETE FROM produit WHERE id_p = ?");
     $req->execute([$l]);
     $req->closeCursor();
     header("Location: ../dashboard");
   }
 }
}
else {
  header("../../my-account");
}
