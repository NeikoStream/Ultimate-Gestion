<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="<?php if (isset($cheminStyle)) {echo $cheminStyle;} else { echo '../css/style.css';} ?>" rel="stylesheet" />
    <link rel="shortcut icon" type="image/png" href="<?php if (isset($cheminLogo)) {echo $cheminLogo;} else { echo '../img/frisbee.png';} ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php if (isset($title)) {echo $title;} else { echo 'Ultimate';} ?></title>
  </head>
  <body>
    <div class="container">
      <div class="logo">
        <img src="<?php if (isset($cheminLogo)) {echo $cheminLogo;} else { echo '../img/frisbee.png';} ?>" alt="" width="130" />
        
      </div>
      <div class="Texte-Logo">Toulouse Ultimate Club
      </div>
      <nav>
        <ul>
          <a href=""><li>Accueil</li></a>
          <a href=""><li>Match</li></a>
          <a href="page/saisieJoueur.php"><li>Joueurs</li></a>
          <a href=""><li>Statistique</li></a>
        </ul>
      </nav>
    </div>