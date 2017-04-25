<?php
session_start();
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
<div id="panelp" class="panel panel-default">
  <h3>Ajouter un produit</h3>
<form action="#" method="post" id="formAdd">
    <table>

      <tr>
          <td><label for="nomp">Nom  du Produit :</label></td>

      </tr>
      <tr>
     <td><input class="form-control" type="text" id="nom" name="nomp" /></td>
      </tr>

      <tr>
      <td><label for="nom">Image:</label></td>
    </tr>
    <tr>
      <td><img src="image.gif" border="1">
      <img src="image.gif" border="1">
        <img src="image.gif" border="1">
        <img src="image.gif" border="1">
        <img src="image.gif" border="1">
      <img src="image.gif" border="1"></td>
    </tr>


      <tr>
      <td><label for="cat">Catégorie:</label></td>
    </tr>
    <tr>

      <td><input class="form-control" type="text" id="cat" name="cat"/></td>

    </tr>

      <tr>
      <td><label for="price">Prix:</label>
    </tr>

      <tr>
    <td><input class="form-control" type="number" id="price" name="price"/></td>
    <td><label>HT</label></td>
   <td><input class="form-control" type="number" id="p_ht" name="ht"/></td>
      <td><label for="p_ttc">TTC:</label></td>
      <td><input class="form-control" type="number" id="p_ttc" name="ttc" /></td>

    </tr>


      <tr>
      <td><label for="qt">Quantité:</label></td>
    </tr>
<tr>
<td><input class="form-control" type="number" id="qt" name="qt"/></td>
</tr>


  </table>
    <br>
    <br>
    <div style="margin:0 auto;width:122px;">
      <input class="button" type="submit" id="btn" name="envoi" value="Valider">
    </div>


</form>
</div>

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
         <button type="button" class="btn btn-default closeme" data-dismiss="modal">Fermer</button>
       </div>
     </div>

   </div>
 </div>


<script type="text/javascript" src="../../rsc/js/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="../../rsc/bootstrap-3.3.7/js/bootstrap.min.js"> </script>
<script type="text/javascript" src="../js/p_process.js"></script>
</body>
</html>
