<?php
require_once("../rsc/require/db.php");

$id_c = $_SESSION['user_id'];
$produits = array(); $produits_liste = ""; $afficher = false;
//,panier.id_p,panier.Nb_du_produit,panier.Sous_total
//panier.id_p,panier.Nb_du_produit,panier.Sous_total
$req = $bdd->prepare("SELECT panier.*,produit.* FROM panier  JOIN produit ON  panier.id_p = produit.id_p  WHERE panier.id_c = ?");
$req->execute([$id_c]);
$res= $req->rowCount();
$total = 0;
while($produits = $req->fetch(PDO::FETCH_ASSOC))
{
  $total += $produits['Sous_total'];
  $produits_liste .= '

						<tr>
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-2 hidden-xs"><img src="" alt="" class="img-responsive"></div>
									<div class="col-sm-10">
										<h4 class="nomargin">'.$produits['Nom_produit'].'</h4>
										<p>'.$produits['description'].'</p>
									</div>
								</div>
							</td>
							<td data-th="Price">'.$produits['prix_p'].'</td>
							<td data-th="Quantity" style="text-align:center;">
							'.$produits['Nb_du_produit'].'
							</td>
							<td data-th="Subtotal" class="text-center">'.$produits['Sous_total'].'</td>
							<td class="actions" data-th="">

								<a href="panier/del.php?l='.$produits['id_panier'].'" class="btn btn-danger btn-sm ">Supprimer</button>
							</td>
						</tr>

          ';
}
$req->closeCursor();
if($res>0)
{
  echo $produits_liste;

}
else {
  echo "Le panier est vide";
}
