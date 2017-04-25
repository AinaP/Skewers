<?php
session_start();
if(isset($_SESSION['user']) && isset($_SESSION['user_type']) )
{
header("home");
}

// si on est pas connecté
else
{
  $errors =  array(); $errors['msg'] ="";
   if($_SERVER['REQUEST_METHOD']==="POST")
   {
     $nom = htmlspecialchars($_POST['nom']);
     $prenom = htmlspecialchars($_POST['prenom']);
     $adresse = htmlspecialchars($_POST['adresse']);
     $code_postal = htmlspecialchars($_POST['c_postal']);
     $ville = htmlspecialchars($_POST['ville']);
     $mail = htmlspecialchars($_POST['mail']);
     $mdp = htmlspecialchars($_POST['mdp']);
     $mdp2 = htmlspecialchars($_POST['mdp2']);

     var_dump($nom);
     var_dump($prenom);
     var_dump($adresse);
     var_dump($code_postal);
     var_dump($ville);
     var_dump($mail);
     var_dump($mdp);
     var_dump($mdp2);

     /* On crypte le MDP */


     if (!empty($nom) and !empty($prenom) and !empty($adresse) and !empty($code_postal) and !empty($ville) and !empty($mail)  and !empty($mdp) and !empty($mdp2)) /* Si l'un des champs est vide .... */
     {
       require_once("rsc/require/db.php");
     	if (filter_var($mail, FILTER_VALIDATE_EMAIL)== false) /* Utilisation d'une REGEX pour vérifier le format de l'adresse mail */
     	{
     		/* Remplir une ligne du tableau errors avec l'erreur du mail */
     		$errors['mail'] = "L'adresse email n'est pas valide";
     	}

     	else if ($mdp != $mdp2)
     	{
     		/* Remplir une ligne du tableau errors avec l'erreur du mot de passe */
     		$errors['password'] =  "Les mots de passe ne correspondent pas" ;
     	}

      // aucune erreur donc  on fait le traitement
     	else
     	{
        $options = ['cost' => 10,];
        $mdp_c = htmlspecialchars(password_hash($mdp, PASSWORD_BCRYPT, $options));


     				/* Vérification si le nom et prénom n'est pas déjà dans la table client */
     				$req = $bdd->prepare('SELECT * FROM client WHERE nom = ? AND prenom = ?');
     				$req->execute([$nom,$prenom]);
     				$res = $req->fetch(PDO::FETCH_ASSOC); // On stocke dans une variable $res si il y a un match
            $req->closeCursor();
     				if ($res)
     				{
     					/* On insère dans le tableau errors l'erreur mail */
     					$errors['msg'] = "Le couple nom et prénom saisis existe déjà !" ;
     				}

     				else
     				{
              $req = $bdd->prepare('SELECT * FROM client WHERE mail= ? '); // Préparation de la req : On cherche le mail dans la table client
       				$req->execute([$mail]);
       				$res = $req->fetch(PDO::FETCH_ASSOC); // On stocke dans une variable $res si il y a un match
              $req->closeCursor();
              if($res) { $errors['mail'] = "Cette adresse mail est déjà utilisée !"; }

              // tout est bon ,
              else
              {
     					/* Insertion dans la tabel client si toutes les conditions ci dessus sont remplies */
     					$req = $bdd->prepare('INSERT INTO client SET address=?,  code_postal =?, ville=?, nom=?, prenom=?, mdp=?, mail=?'); // Préparation de la req : On insère dans la table client
     					$req->execute([
                $adresse,
                $code_postal,
                $ville,
                $nom,
     						$prenom,
     						$mdp_c,
     						$mail,

     					]);
              $req->closeCursor();

     					$errors['msg']="Votre compte a bien été créé ! Connectez vous pour y accéder .";
              }
     				}



     		}
        // fin traitement
     	}
      // fin si tous les champs ont été rempli
      else
      {
        $errors['empty'] = "Assurer vous d'avoir tout complété !";
      }

     }
     // fin si la méthode est post

     // comme method n'est pas post , ben on fait rien,
     else
     {
       $errors = "";
     }

   }

?>

<!DOCTYPE html>
<html lang="fr">
<head>

  <title>Inscription</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="rsc/bootstrap-3.3.7/css/bootstrap.css">
  <link rel="stylesheet" href="rsc/css/cms.css">

</head>
<body>


<nav class="navbar navbar-default navbar-top">
  <div class="container">
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
        <li><a href="acheter.html">Acheter</a></li>
        <li><a href="vendre.html">Vendre</a></li>
        <li><a href="conect.html">Connexion / inscription</a></li>
        <li><a href="contact.html">Contact</a></li>
        <li><a href="propos.html">A Propos</a></li>

         <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Catégorie<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Musique</a></li>
            <li><a href="#">nouriture</a></li>
            <li><a href="#">sport</a></li>
          </ul>
            <li><a href="panier.php">Panier</a></li>
        </li>
      </ul>
    </div>
  </div>
</nav>

  <div class="jumbotron text-center">
      <h1>Créer un compte</h1>
      </div>
    </div>
  </form>
</div>



<div class="container">
<p><?php if($errors)
{foreach ($errors as $error) {echo $error;}  } ?></p>
  <form method="post">
  <div class="form-group">
    <label for="nom">Nom</label>
    <input type="text" class="form-control" id="nom" aria-describedby="" name="nom" placeholder="Votre Nom">
  </div>

    <div class="form-group">
      <label for="prenom">Prénom</label>
      <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre Prénom">
    </div>

    <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="mail" aria-describedby="emailHelp" placeholder="Email">
  </div>

  <div class="form-group">
    <label for="mdp">Mot de Passe</label>
    <input type="password" class="form-control" id="mdp" name="mdp" placeholder="********">
  </div>

    <div class="form-group">
    <label for="mdp">Confirmer Votre Mot de Passe</label>
    <input type="password" class="form-control" id="mdp" name="mdp2" placeholder="********">
  </div>

    <div class="form-group">
      <label for="adresse">Adresse</label> : <input type="text" name="adresse" id="adreses" class="form-control">
      <label for="c_postal">Code postal</label> : <input type="number" name="c_postal" id="c_postal" class="form-control"><br>
      <label for="ville">Ville</label> : <input type="text" name="ville" id="ville" class="form-control">
    </div>



  <button type="submit" class="btn btn-primary">Confirmer l'inscription</button>
</form>
</div>

<div id="foot">
  <h4>Skewers,  All rights reserved &copy 2017</h4>
</div>

  <script type="text/javascript" src="rsc/js/jquery-2.2.4.min.js"></script>
  <script type="text/javascript" src="rsc/bootstrap-3.3.7/js/bootstrap.js"></script>


</body>
</html>
