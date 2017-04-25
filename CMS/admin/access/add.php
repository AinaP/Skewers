<?php
session_start();

/* On récupère le nom des catégories */
require_once("../../rsc/require/db.php");
$res = array();
$select = "";
$req = $bdd->prepare('SELECT * FROM categorie');
$req->execute();
$res = $req->fetch(PDO::FETCH_ASSOC);
while($res)
{
  $select .= '<option' . ' value=' . $res['id_cat'] . '>' . $res['nom_cat'] . '</option>';
  $res = $req->fetch(PDO::FETCH_ASSOC);

}
$count = $req->rowCount();
$req->closeCursor();

/* On met le résultat des catégories dans un tableau */

 ?>

<!Doctype html>
<html>
<head>

<meta charset="utf-8">
<link rel="stylesheet" href="../css/add.css">
<title> Ajouter un produit </title>
<link rel="stylesheet" href="../../rsc/bootstrap-3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="../../rsc/css/uni.css";
</head>

<body>

    <div id="panelp" class="col-sm-8 col-sm-offset-2  ">
      <form id="formAdding" action="#"  onsubmit="return false;" method="post" enctype="multipart/form-data" >
        <div id="name">
          <center><p><b>Ajouter un produit</b></p></center>
        </div>
        <div class="form-group">
          <label for="productName">Nom du produit</label>
          <input type="text" class="form-control" id="productName" placeholder="Le nom de votre produit" name="productName">
        </div>
        <div class="form-group">
          <label for="productPrice">Prix en Euros</label>
          <input type="number" step="0.01" class="form-control" id="productPrice" placeholder="prix du produit en euros" name="productPrice" >
        </div>
        <div class="form-group">
          <label for="productStock">Stock</label>
          <input type="number" class="form-control" id="productStock" placeholder="Mettre en stock" name="productStock">
        </div>
        <div class="form-group">
          <label for="productDesc">Description</label>
          <textarea class="form-control" name="productDesc" id="productDesc" form="addForm">Décrivez votre produit</textarea>
        </div>
        <div class="form-group">
           <label for="productCategory">Catégorie</label>
           <select class="form-control" id="productCategory" name="productCategory">
             <?php
            echo $select ;
             ?>
           </select>
         </div>
         <div class="form-group">
           <label for="filetoUpload">Image descriptive</label>
           <input type="file" accept="image/*" name="imageDesc" id="fileToUpload">
         </div>
          <div class="container col-md-2 col-md-offset-5">
            <input type="submit" class="btn btn-primary" name="submit"  value="Ajouter">
        </div>
      </form>
    </div>

<!-- -->

      <!-- Trigger the modal with a button -->
      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
              <p id="msg">Some text in the modal.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default closeme" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>




<script type="text/javascript" src="../../rsc/js/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="../../rsc/bootstrap-3.3.7/js/bootstrap.min.js"> </script>
<script type="text/javascript" src="../js/adding_products.js"></script>
</body>
</html>
