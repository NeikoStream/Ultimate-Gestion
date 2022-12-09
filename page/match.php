<?php 

//Partie empechant l'utilisateur non connecter a accéder au contenue (mettre en commentaire pour modifier le code facilement)
require '../fonctionPHP/authentification.php';
forcer_utilisateur_connecte();
//Appel du header
$title = "Match";
require 'header.php'; 
require 'saisieMatch.php'
require 'saisiePartiper.php'
?>