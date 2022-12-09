<?php 

//Partie empechant l'utilisateur non connecter a accéder au contenue (mettre en commentaire pour modifier le code facilement)
require '../fonctionPHP/authentification.php';
forcer_utilisateur_connecte();
//Appel du header
$title = "Accueil";
require 'header.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="../img/frisbee.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
    <p>Bienvenue</p>
</body>
</html>