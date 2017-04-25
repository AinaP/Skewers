<?php
session_start();
if($_SERVER['REQUEST_METHOD']==="POST" && $_POST['r_type']==="search")
{
  require_once("../require/db.php");

  $motcle = $_POST['motcle']; $categorie = false; $donnee ="";

  // si on a rien taper dans la barre de recherche,alors on affiche tous les produits de la categorie choisie
  if(empty($motcle))
  {
    $req = $bdd->prepare("SELECT * FROM produit");
    $req->execute();
    $produits = array(); $produits_liste = "";
    $nb = $req->rowCount();
    while($produits = $req->fetch(PDO::FETCH_ASSOC) )
    {
      $produits_liste .=
      '<div id="' .$produits['id_p'] .'" class="item  col-xs-4 col-lg-4">
          <div class="thumbnail">
              <img class="group list-group-image" src="../rsc/images/p/'.$produits['image']. '"alt="" />
              <div class="caption">
                  <h4 class="group inner list-group-item-heading">'.$produits['Nom_produit'] .'</h4>
                  <p class="group inner list-group-item-text">'. $produits['description'] .'</p>
                  <div class="row">
                      <div class="col-xs-12 col-md-6">
                          <p class="lead">'.$produits['prix_p'] .'€</p>
                      </div>
                      <div class="col-xs-12 col-md-6">
                      <a id="'.$produits['id_p'].'"class="btn btn-success panier" >Ajouter au panier</a>
                      <a href="detail?p='.$produits['id_p'].'" class="btn btn-info voir" >Voir</a>
                      </div>
                  </div>
              </div>
          </div>
       </div>';
    }
    if(isset($_SESSION['user']) && isset($_SESSION['user_type']) && isset($_SESSION['user_id']) )
    {echo $produits_liste;}

    //comme on n'est pas connecté, on n'affiche pas le bouton Ajouter au panier
    else {
      $produits_liste =
      '<div id="' .$produits['id_p'] .'" class="item  col-xs-4 col-lg-4">
          <div class="thumbnail">
              <img class="group list-group-image" src="../rsc/images/p/'.$produits['image']. '"alt="" />
              <div class="caption">
                  <h4 class="group inner list-group-item-heading">'.$produits['Nom_produit'] .'</h4>
                  <p class="group inner list-group-item-text">'. $produits['description'] .'</p>
                  <div class="row">
                      <div class="col-xs-12 col-md-6">
                          <p class="lead">'.$produits['prix_p'] .'€</p>
                      </div>
                      <div class="col-xs-12 col-md-6">
                          <a href="detail?p='.$produits['id_p'].'" class="btn btn-info voir" >Voir</a>
                      </div>
                  </div>
              </div>
          </div>
       </div>';
       echo $produits_liste;
    }
    // fin si on n'est pas connecté
  }

// comme on a saisie qulelque chose , alors on lance la recherche parmi la catégorie sélectionnée
  else
  {
    // si on est connecté on ajoute le bouton Ajouter au panier


    $produits = array(); $produits_liste="";
    $req = $bdd->prepare("SELECT * FROM produit WHERE Nom_produit LIKE ? OR motcle Like ?");
    $req->execute(["%".$motcle."%","%".$motcle."%"]);
    $res = $req->rowCount();
    while($produits = $req->fetch(PDO::FETCH_ASSOC))
    {
    $produits_liste .=
    '<div id="' .$produits['id_p'] .'" class="item  col-xs-4 col-lg-4">
        <div class="thumbnail">
            <img class="group list-group-image" src="../rsc/images/p/'.$produits['image']. '"alt="" />
            <div class="caption">
                <h4 class="group inner list-group-item-heading">'.$produits['Nom_produit'] .'</h4>
                <p class="group inner list-group-item-text">'. $produits['description'] .'</p>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <p class="lead">'.$produits['prix_p'] .'€</p>
                    </div>
                    <div class="col-xs-12 col-md-6">
                    <a id="'.$produits['id_p'].'"class="btn btn-success panier" >Ajouter au panier</a>
                    <a href="detail?p='.$produits['id_p'].'" class="btn btn-info voir" >Voir</a>
                    </div>
                </div>
            </div>
        </div>
     </div>';
    }
    $req->closeCursor();
    if(isset($_SESSION['user']) && isset($_SESSION['user_type']) && isset($_SESSION['user_id']) )
    {
      // si on est connecté
    }

    //comme on n'est pas connecté, on n'affiche pas le bouton Ajouter au panier
    else {
      $produits_liste =
      '<div id="' .$produits['id_p'] .'" class="item  col-xs-4 col-lg-4">
          <div class="thumbnail">
              <img class="group list-group-image" src="../rsc/images/p/'.$produits['image']. '"alt="" />
              <div class="caption">
                  <h4 class="group inner list-group-item-heading">'.$produits['Nom_produit'] .'</h4>
                  <p class="group inner list-group-item-text">'. $produits['description'] .'</p>
                  <div class="row">
                      <div class="col-xs-12 col-md-6">
                          <p class="lead">'.$produits['prix_p'] .'€</p>
                      </div>
                      <div class="col-xs-12 col-md-6">
                      <a href="detail?p='.$produits['id_p'].'" class="btn btn-info voir" >Voir</a>
                      </div>
                  </div>
              </div>
          </div>
       </div>';

    }
    // fin si on n'est pas connecté
    switch($res) {
      case 0 :
      $donnee = "Aucun résultat pour ".$motcle;
        echo $donnee ;
      break;

      case 1 :
      $donnee = $res ." résultat@".$produits_liste;
      echo $donnee;
      break;

      default:
      $donnee = $res ." résultats@".$produits_liste;
      echo $donnee;
      break;
    }

  }
  // fin pour motcle non vide
}
