<?php
session_start();
if(isset($_SESSION['user']) && isset($_SESSION['user_type']) && isset($_SESSION['user_id']))
{
  $usertype = $_SESSION['user_type'];
  if($usertype === "admin")
  require_once("../rsc/require/db.php");
  else {
    header("../home");
  }
}
else {
  header("Location: ../my-account");
}

?>
<!Doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title> Skewers </title>


  <link rel= "stylesheet" href="css/head.css" >
  <link rel= "stylesheet" href="css/foot.css" >
  <link rel= "stylesheet" href="css/seller.css" >
  <link rel= "stylesheet" href="css/corps.css" >
  <link rel= "stylesheet" href="../rsc/bootstrap-3.3.7/css/bootstrap.css">
  <link rel="stylesheet" href="css/orders.css">
  <link rel="stylesheet" href="css/search.css">


</head>

<body onresize="auto_size();">
  <form name="t">
    <?php $n = $_SERVER['HTTP_USER_AGENT'];

  if (preg_match("/firefox/i", $n))
  {
    echo '<input type="hidden" name="n" id="n" value="f">';
  }
  else
  {
    echo '<input type="hidden" name="n" id="n" value="ok">';
  }
  ?>
  </form>

  <div id ="head">
  <h3 class="ls">S</h3>
  <h3 class="lk">k</h3>
  <h3 class="le">e</h3>
  <h3 class="lw">w</h3>
  <h3 class="le">e</h3>
  <h3 class="lr">r</h3>
  <h3 class="ls">s</h3>
  </div>

  <div id="dashboard" class="nav">
    <div id="section_dash">
      <p>TABLEAU DE BORD</p>
    </div>

    <div id="MenuH">


      <div id="section_search">
        <form action="?action=search" method="post">
        <input type="text" class="form-control">
        <input type ="submit" value="" class="btn-default " id="btn_search">
      </form>
      </div>

     <div id="section_profil">
       <img id="set" src="../rsc/img/default/settings-1.png" onclick='show_menu("#dropdown",false)'>
       <?php //là où sera écrit le nom de l'employé ?>

       <div id="dropdown">
         <ul>
           <li><a href="">Mon compte</a></li>
           <li><a href="#">Mes tâches</a></li>
           <li><a>___________</a></li>
           <li><a href="?action=logout">Déconnexion</a></li>

       </div>
     </div>

    </div>


  </div>

<?php // -------------------------------------------------------------------------------------------------------?>
<div id="corps">

  <div id="side">
    <?php // debut de tableau de bord ?>
   <div id="myshop" class="side-items">
     <div id="btn-dash" class="btn-side" onclick='show_menu("#dash_menu",true);'>
       Interface
     </div>
    <div id="dash_menu">
      <ul>

        <li><span>></span><a href="?view=messages">Messages</a></li>
        <li><span>></span><a href="?view=notif">Notification</a></li>
      </ul>
   </div>
  </div>
  <?php //fin tableau de bord ?>

<?php // debut de catalog ?>
  <div id="catalog" class="side-items">
    <div id="btn-catalog" class="btn-side" onclick='show_menu("#catalog_menu",true);' >
      CATALOGUE
    </div>
   <div id="catalog_menu">
     <ul>
       <li><span>></span><a href="?view=products">Produits</a></li>
       <li><span>></span><a href="?view=categories">Catégorie</a></li>
     </ul>
  </div>
 </div>

 <?php // fin catalog ?>


 <?php // debut de catalog ?>
   <div id="client" class="side-items">

     <div id="btn-client" class="btn-side" onclick='show_menu("#client_menu",true);'>
       CLIENTS
     </div>
    <div id="client_menu">
      <ul>
        <li><span>></span><a href="?view=customer&t=all">Tous les clients</a></li>

      </ul>
   </div>
  </div>

  <?php // fin catalog ?>




  <?php // fin side ?>
</div>






  <div id="main">

<?php
$pagenow = "dash";
require("access/dash.php");
if (empty($_GET))
  $parametre = "";
else
{

  if(isset($_GET['view']) )
  {
  $parametre = $_GET['view'];

   switch($parametre)
   {

    case  'orders' :
    echo '<h2>Les commandes</h2>';
    require("sell/orders.php");
    $pagenow = "orders";
    break;


    case 'notif':
        echo '<h2>Les Notifications</h2>';
        $pagenow = "notifs";
    break;

    case  'products':

      require("access/products.php");
      $pagenow = "products";
    break;

    case  'categories':
      echo '<h2>Les catégories</h2>';
      require("access/category.php");
      $pagenow = "cat";
    break;

    case  'customer' :
      echo '<h2>Nos clients</h2>';
      $pagenow = "customers";
      require("access/customers.php");
    break;
  }

 }


    if(isset($_GET['action']) )
     {
       $action = $_GET['action'];
       switch($action)
       {
         case "logout":
         header("Location: ../logout.php");
         break;

         case "search":
         require("access/search.php");

         break;

       }
     }




}
?>
</div>

<?php // fin corps ?>
</div>






<script type="text/javascript" src="../rsc/js/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="../rsc/bootstrap-3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/fct.js"></script>
<script type="text/javascript" src="js/seller.js"></script>


<?php
switch($pagenow) {

case  "search":
echo '';
break;

case "orders" :
echo '';
break;

case "msgs":
echo '';
break;

case "notifs":
echo '';
break;

case "products":

echo '<script type="text/javascript" src=""></script>
<script type="text/javascript">

</script>';
break;

case "cat":
break;

case "customers":
break;

default:
break;
}


?>

</body>
</html>
