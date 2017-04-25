<?php
$serveur ="localhost";
$nom_bdd = "skewers";
$user_bdd = "root";
$mdp_bdd = "root";
$bdd = new PDO("mysql:host=$serveur;dbname=$nom_bdd;charset=utf8", $user_bdd, $mdp_bdd);

$bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
