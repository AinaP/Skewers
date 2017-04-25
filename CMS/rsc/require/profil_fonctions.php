<?php
$achat = array(); $achat_liste = "";
$req = $bdd->prepare("SELECT * FROM commande WHERE id_c = ?");
$req->execute([$id]);
while ($achat = $req->fetch(PDO::FETCH_ASSOC)) {
  $achat_liste .= '<tr class="success">
    <td>'.$achat['id_com'].'</td>
      <td>'.$achat['nbr_art_com'].'</td>
    <td>'.$achat['prix_com'].'</td>
    <td>'.$achat['statut_com'].'</td>
    <td></td>
  </tr>';

}
$req->closeCursor();

$idc = $_SESSION['user_id'];
$info = array(); $info_liste = "";
$req2 = $bdd->prepare("SELECT * FROM client WHERE id_c = ?");
$req2->execute([$idc]);
while ($info = $req2->fetch(PDO::FETCH_ASSOC)) {
  $info_liste .=
  '<h2>Infos</h2><br>

  <h3>Votre Adresse Mai</h3>
  <p>'.$info['mail'].'</p>

  <h3>Votre Mot De Passe</h3>
  <p>'.$info['mdp'].'</p>
  <h3>Nom</h3>
  <p>'.$info['nom'].'</p>
  <h3>Prénom</h3>
  <p>'.$info['prenom'].'</p>';

}

$req2->closeCursor();


$idcl = $_SESSION['user_id'];
$mesproduits = array(); $mp_liste = "";
$req3 = $bdd->prepare("SELECT * FROM produit INNER JOIN categorie ON produit.id_cat = categorie.id_cat WHERE id_c = ?");
$req3->execute([$idcl]);
while ($mesproduits = $req3->fetch(PDO::FETCH_ASSOC)) {
  $mp_liste .= '
  <tr class="success">
    <td>'.$mesproduits['image'].'</td>
      <td>'.$mesproduits['Nom_produit'].'</td>
          <td>'.$mesproduits['detail_cat'].'</td>
    <td>'.$mesproduits['description'].'</td>
    <td>'.$mesproduits['prix_p'].'</td>
    <td>'.$mesproduits['Statut'].'</td>
    <td></td>
  </tr>';
  ;

}

$req3->closeCursor();
