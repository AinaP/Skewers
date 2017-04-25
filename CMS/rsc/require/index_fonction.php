<?php
$donnees = "";
$last_item = array();
require_once('db.php');
$req = $bdd ->prepare('SELECT * FROM produit ORDER BY id_p DESC LIMIT 4');
$req -> execute();
$last_item = $req -> fetch(PDO::FETCH_ASSOC);


while ($last_item = $req -> fetch(PDO::FETCH_ASSOC))
{

	$donnees .= '
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">

        <div class="panel-body"><img src="rsc/images/p/'.$last_item['image'].'" class="img-responsive" style="width:100%" alt="Tamerelachienne">
        </div>
        <div class="panel-footer">'.$last_item['Nom_produit'].'</div>
      </div>
    </div>
  </div>';

}
?>