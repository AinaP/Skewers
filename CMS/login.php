<?php
session_start();
if ( isset($_SESSION['user'])  && isset($_SESSION['user_type']) && isset($_SESSION['user_id'])) // iu = id de l'utilisateur
{
  header("Location: home");
}

// nous sommes pas connectés
else
{
  $errors = array();


if(isset($_POST['btnConnect']) && $_SERVER['REQUEST_METHOD'] === 'POST')
{


   $idt = $_POST['idt'] ;
    $mdp = ($_POST['mdp']);
    $keepme = false; //On initialise la checkbox à 0 d'abord

     if(isset($_POST['keepme']) )
            $keepme = true;
           else
            $keepme = false;

     if ( !empty($idt) && !empty($mdp) )
     {



        require('rsc/require/db.php');
// Vérification des identifiants
      if($idt ==="shazad@skewers.com" || $idt ==="vato@skewers.com" || $idt ==="dylan@skewers.com" || $idt ==="damien@skewers.com" || $idt ==="aina@skewers.com" )
      {
        $req = $bdd->prepare("SELECT * FROM admin WHERE mail = ? AND mdp = ? ");
        $req->execute([$idt,$mdp]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        if($result)
        {
          $_SESSION['user_type'] = "admin";
          // identifiant utilisateur varchar( non pas l'id)
          $_SESSION['user'] = $result['prenom'] ."  " .$result["nom"];
          $_SESSION['user_id'] = $result['id_a'];

          setcookie('idt', $idt, time()+3600*24*365);
          setcookie('mdp', $mdp, time()+3600*24*365);
          setcookie("msg","connected",time()+3600*24*365);
          //var_dump($_SESSION['user_type']);
          header("Location: home");
        }
        else {
          $errors['msg'] = "Mot de passe incorrect !";
        }

      }


      else
      {
        $options = ['cost' => 10,];
        $mdp_c = htmlspecialchars(password_hash($mdp, PASSWORD_BCRYPT, $options));
       $req = $bdd->prepare("SELECT * FROM client WHERE mail = ? ");
       $req->execute([$idt]);
       $result = $req->fetch(PDO::FETCH_ASSOC);
       $req->closeCursor();
         if($result)
         {
         $hash = $result['mdp'];
         if(password_verify($mdp,$hash))
         {

         // identifiant utilisateur varchar( non pas l'id)
         $_SESSION['user'] = $result['prenom'] ."  " .$result["nom"];
         $_SESSION['user_id'] = $result['id_c'];
         $_SESSION['user_type'] = "customer";
         if($keepme == true)
         {
         setcookie('auto',$keepme,time()+3600*24*365);}
         else
         {//rien
         }
         setcookie('idt', $idt, time()+3600*24*365);
         setcookie('mdp', $mdp, time()+3600*24*365);
         setcookie("msg","connected",time()+3600*24*365);
         header("Location: profil/me");
         }
         else {
           $errors['msg'] = "Mot de passe incorrect !";
         }

         }

         else
         {
            $errors['login'] = "Ce compte n'existe pas !";
            setcookie("login_error","error login",time()+3600*24*365);


         }

      }


        // non mmebre

     }

     // champs non remplis
     else
     {
     $errors['login'] = "Veuillez remplir les champs demandés !";

     setcookie("msg","incomplete form",time()+3600*24*365);
     setcookie("login_error","empty",time()+3600*24*365);
     }


}




}
// fin else nou sommes pas connectés

?>

<!DOCTYPE html>
<html>

<head>
<title>Connexion</title>
<meta charset="UTF-8">
<meta name="viewport"  content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="rsc/css/cms.css" >
<link rel="stylesheet" href="rsc/bootstrap-3.3.7/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="rsc/css/login.css">
<link rel="stylesheet" type="text/css" href="rsc/css/foot.css">



</head>


<body onresize="foot();" onload="foot();">


  <nav id="hd" class="navbar navbar-default navbar-top">
    <div class="container" id="sc">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <a class="navbar-brand" href="home">Skewers</a>
      </div>

      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">


          <li><a href="catalog/allproducts">Les offres</a></li>


        </ul>
      </div>
    </div>

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
</nav>


<?php //fin entete ?>





    <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="rsc/images/default/user_m.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" name="idt" id="inputEmail" class="form-control" placeholder="Adresse mail" required autofocus>
                <input type="password" name="mdp" id="inputPassword" class="form-control" placeholder="Mot de passe" required>
                <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Se souvenir de moi
                    </label>
                </div>
                <button name="btnConnect" class="btn btn-lg btn-info btn-block btn-signin" type="submit">Se connecter</button>
                <a class="btn btn-lg btn-primary btn-block btn-signin" href="signup.php">Inscription</a>
            </form><!-- /form -->
            <a href="forgot.php" class="forgot-password">Mot de passe oublié ?</a>
            <br>
            <b style="color:#39F;"><?php
            if($errors)
            {foreach ($errors as $error ) { echo $error ;}}?></b>
        </div><!-- /card-container -->
    </div><!-- /container -->



   <?php // fin MP?>

   <div class="footer" id="footer">
       <div class="container">
           <div class="row">
               <div class="col-lg-3  col-md-3 col-sm-4 col-xs-6">
                   <h3> A propos de nous </h3>
                   <ul>
                       <li> <a href="about"> Qui nous sommes </a> </li>


                   </ul>
               </div>
               <div class="col-lg-3  col-md-3 col-sm-4 col-xs-6">
                   <h3> Localiser </h3>
                   <ul>
                       <li> 25 Rue de la réussite 75012 </li>


                   </ul>
               </div>
               <div class="col-lg-3  col-md-3 col-sm-4 col-xs-6">
                   <h3> Des questions ? </h3>
                   <ul>
                       <li> <a href="#"> contact@skewers.com </a> </li>
                       <li> <a href="#">01 07 07 07 69</a> </li>

                   </ul>
               </div>

               <div class="col-lg-3  col-md-3 col-sm-6 col-xs-12 ">

               </div>
           </div>
           <!--/.row-->
       </div>
       <!--/.container-->
   </div>
   <!--/.footer-->

   <div class="footer-bottom">
       <div class="container">
           <p class="pull-left"> Copyright © Skewers 2017. All right reserved. </p>

       </div>
   </div>




<!-- script here-->
<?php //var_dump($errors) ?>
<script type="text/javascript" src="rsc/js/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="rsc/bootstrap-3.3.7/js/bootstrap.js"></script>
<script type="text/javascript" src="rsc/js/login.js"></script>

</body>
</html>
