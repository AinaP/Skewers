<?php
if($_SERVER['REQUEST_METHOD']==="POST")
{
  $loadtype  = $_POST['load_type'];
  if(empty($loadtype))
  {
    echo "Une erreur est survenue ,merci de réessayer !";
  }

  // le type de chargement demandé : par ex chargement de produit ,messages,categorie
  else
  {
     require_once("../../rsc/require/db.php");  # code...
     $pv = ""; $pnv ="";
     switch($loadtype)
     {
       case "pv" :
       $req = $bdd->prepare("SELECT * FROM produit WHERE Statut=1");
       $req->execute();
       $products_ok = array(); $products_not_ok = array();
       /*$msg="<tr><th>ID</th>
       <th>Image</th>
       <th>Nom du produit</th>
       <th>Catégorie</th>
       <th>Prix</th>
       <th>Statut</th>
       </tr>";*/


        while($products_ok=$req->fetch(PDO::FETCH_ASSOC))
        {
        $pv .=
        '<tr>
         <td><img src=""></td>
         <td>'.$products_ok['Nom_produit'].'</td>
         <td>'.$products_ok['prix_p'].'</td>
         <td>'.$products_ok['Statut'].'</td>
         <td>'.$products_ok['id_cat'].'</td>
         <td><img><img></td>
         </tr>';
        }
        $req->closeCursor();
        echo $pv;
        break;

        case "pnv":
        $req2=$bdd->prepare("SELECT * FROM produit WHERE Statut=0") ;
        $req2->execute();
        while($products_not_ok=$req2->fetch(PDO::FETCH_ASSOC))
        {
        $pnv .=
        '<tr>
         <td><img src=""></td>
         <td>'.$products_not_ok['Nom_produit'].'</td>
         <td>'.$products_not_ok['prix_p'].'</td>
         <td>'.$products_not_ok['Statut'].'</td>
         <td>'.$products_not_ok['id_cat'].'</td>
         <td><img><img></td>
         </tr>';

        }
        $req2->closeCursor();
        echo $pnv;
        break;

        default:
        echo "Chargement de données non réussi ! Nouvel essai ...";
        break;

      }
   }
   // fin type de chargement

}
//fin si requete est POST

// la requete n'est pas post donc erreur
else
{

  echo "Le chargement de donnée a été interrompu ! Si le problème persiste,veuillez contacter l'administrateur !";
}
