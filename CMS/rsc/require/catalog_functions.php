<?php
$produits = array();
$produits_liste = ""; $recherche = "";
if(isset($_SESSION['user']) && isset($_SESSION['user_type']) && isset($_SESSION['user_id']))
{
 $connected = true;
// stat -> afficher dans le header Panier et Mon compte si on est connecté
 $stat=' <li><a href="../profil/mycart">Panier</a></li>
 <li class="dropdown">
       <a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$_SESSION['user'].'<span class="glyphicon glyphicon-user pull-right"></span></a>
       <ul class="dropdown-menu">
         <li><a href="../profil/me">Mon compte <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
         <li class="divider"><span class="glyphicon glyphicon-cog pull-right"></span></li>
         <li><a href="../disconnect">Déconnexion <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
       </ul>
     </li>';
}
else
{
 $connected = false;
 $stat = '  <li><a href="../login.php">Se connecter</a></li>
   <li><a href="../signup.php">S\'inscrire</a></li>';

}

$categorie = array(); $categorie_liste = "";
$reponse =$bdd ->prepare('SELECT * FROM categorie');
$reponse->execute();

//tant qu'on a une catégorie, on le met dans un string qui sera ensuite mis dans un select plu bas
while($categorie = $reponse->fetch(PDO::FETCH_ASSOC))
{
 $categorie_liste .= '<option>'.$categorie['detail_cat'].'</option>';
}
$reponse->closeCursor();



//si on n'a pas cherché un produit alors on affiche tous les produits
if(empty($_GET))
{
 $req1 = $bdd->prepare("SELECT * FROM produit");
 $req1->execute();

 //on vérifie si on est connecté,si oui, afficher "Ajouter au panier"
   if($connected==true)
   {

    while($produits = $req1->fetch(PDO::FETCH_ASSOC))
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
                  <a id="'. $produits['id_p'] .'"class="btn btn-success panier" href="#">Ajouter au panier</a>
                  <a href="detail?p='.$produits['id_p'].'" class="btn btn-info voir" href="#">Voir</a>

                </div>
              </div>
          </div>
      </div>
     </div>';
     }
     $req1->closeCursor();
   }

   else
   {
      while($produits = $req1->fetch(PDO::FETCH_ASSOC)) {
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
                   <a href="detail?p='.$produits['id_p'].'" class="btn btn-info voir" >Voir</a>

                 </div>
               </div>
           </div>
         </div>
       </div>';
       }
       $req1->closeCursor();

    }
 // fin si on est pas connecté qaund on n'a rien envoyé en paramètre

}
// fin de empty GET -> on n'a rien envoyé en paramètre p que l'on soit connecté ou pas

//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
// comme on a un paramètre envoyé en GET, on traite alors la recherche
else
{
// si le paramètre p existe , si oui, p correspond au nom du produit
  if(isset($_GET['p']))
  {
  $p = $_GET['p'];
  $req2 = $bdd->prepare("SELECT * FROM produit WHERE  Nom_produit LIKE ? OR motcle LIKE ?");
  $req2->execute(["%".$p."%","%".$p."%"]);
  $nb_res = $req2->rowCount();

  // on vérifie si on est connecté // si oui afficher bouton Ajouter au panier// sinon ne pas l'afficher
     if($connected==true)
     {

       while($produits = $req2->fetch(PDO::FETCH_ASSOC))
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
                   <a id="'. $produits['id_p'] .'"class="btn btn-success panier" href="#">Ajouter au panier</a>
                   <a href="detail?p='.$produits['id_p'].'" class="btn btn-info voir" >Voir</a>

                 </div>
               </div>
            </div>
          </div>
       </div>';
       }
       $req2->closeCursor();
      }
     // fin si on est connecté et qu'on a envoyé qqch en paramètre

//on n'est pas connecté , mais on a envoyé qqch en paramètre
      else
      {
        while($produits = $req2->fetch(PDO::FETCH_ASSOC))
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
                    <a href="detail?p='.$produits['id_p'].'" class="btn btn-info voir" >Voir</a>

                     </div>
                  </div>
               </div>
             </div>
          </div>';
          } //end while
          $req2->closeCursor();

        }
  // fin si on est pas connecté et qu'on  envoyé qqch en paramètre

  switch($nb_res) {
  case 0 :
  $recherche = "Aucun résultat pour ".$p;
  $break;

  case 1 :
      $recherche = "1 résultat pour ".$p;
      $break;

  default :

      $recherche = $nb_res." résultats pour ".$p;
  break;
  }
  // fin switch de nb result

  //fin tant qu'on a des résultats
   }

// fin si [paramètre p]envoyé en GET existe et qu'elle n'est pas vide

//GET contient des paramètres mais aucun n'est = p,alors on affiche tous les produits
   else
   {
   $req3 = $bdd->prepare("SELECT * FROM produit");
   $req3->execute();
   $nb_res = $req3->rowCount();
   // tant qu'on a des résultat , on met dans un string $produits_liste
     if($connected==true)
    {

      while($produits = $req3->fetch(PDO::FETCH_ASSOC))
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
                    <a id="'. $produits['id_p'] .'"class="btn btn-success panier" >Ajouter au panier</a>
                    <a href="detail?p='.$produits['id_p'].'" class="btn btn-info voir" >Voir</a>

                   </div>
                 </div>
             </div>
          </div>
        </div>';
       }
       $req3->closeCursor();
     }
  // fin si on est connecté et que  paramètre p n'existe pas

 // on n'est pas connecté , paramètre p n'existe pas
     else
     {
        while($produits = $req3->fetch(PDO::FETCH_ASSOC))
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
                     <a href="detail?p='.$produits['id_p'].'" class="btn btn-info voir" >Voir</a>

                   </div>
                 </div>
             </div>
           </div>
         </div>';
        }
        $req3->closeCursor();
      }
   // fin si on est pas connecté et que p n'existe pas

   switch($nb_res) {
   case 0 :
   $recherche = "Aucun produit ";
   break;

   case 1 :
       $recherche = "1 produit";
       break;

   default :

       $recherche = $nb_res." produits";
   break;
   }
   // fin switch de nb result

   //fin tant qu'on a des résultats
  }
 }

// fin de << on a envoyé un paramètre qqch>>
