<div class="panel panel-primary">
  <h2>Tous Les produits</h2>
</div>

<h3>Produits en attente de validation</h3>
<div  class="panel panel-primary">
  <table id="pnv" class="table table-bordered table-hover">
   <tr>

    <th>Image</th>
    <th>Nom du produit</th>
    <th>Catégorie</th>
    <th>Description</th>
    <th>Prix</th>
    <th>Statut</th>
  </tr>

  </table>
</div>



<div class="panel panel-default">
<h3>Produits en ligne</h3>
<table id="pv" class="table table-bordered table-hover">
 <tr>

  <th>Image</th>
  <th>Nom du produit</th>
  <th>Catégorie</th>
  <th>Description</th>
  <th>Prix</th>
  <th>Statut</th>
  <th>Action</th>
</tr>

<?php
$produits = array(); $produits_liste = "";
$req = $bdd->prepare("SELECT * FROM produit INNER JOIN categorie ON produit.id_cat = categorie.id_cat ");
$req->execute();
while($produits = $req->fetch(PDO::FETCH_ASSOC))
{
  $produits_liste .= '
  <tr>
  <td>'.$produits['image'].'</td>
  <td>'.$produits['Nom_produit'].'</td>
  <td>'.$produits['detail_cat'].'</td>
  <td>'.$produits['prix_p'].'</td>
  <td>'.$produits['description'].'</td>
  <td>'.$produits['Statut'].'</td>
  <td><a class="btn btn-danger" href="del.php?p=>'.$produits['id_p']. '"</a></td>
  </tr>
  ';
}
$req->closeCursor();
echo $produits_liste;
?>

</table>

 </div>
