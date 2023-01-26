<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link href="../css/style.css" rel="stylesheet" />
  <link rel="shortcut icon" type="image/png" href="../img/frisbee.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    <?php if (isset($title)) {
      echo $title;
    } else {
      echo 'Ultimate';
    } ?>
  </title>
  
</head>

<body>
  <header class="container">
    <nav class="navbar">
    <div class="logo">
      <img src="../img/frisbee.png" alt="" width="130" />

    
      <h1 class="Texte-Logo">
      Toulouse Ultimate Club
      </h1>
    </div>

    <div class="nav-links">
      <ul>
        <li><a href="accueil.php">
            Accueil
          </a></li>
        <li><a href="match.php">
            Matchs
          </a></li>
        <li><a href="adversaires.php">
            Adversaires
        </a></li>
        <li><a href="joueurs.php">
            Joueurs
          </a></li>
        <li><a href="statistiques.php">
            Statistiques
          </a></li>
        <li id="logout"><a href="../fonctionPHP/logout.php">
            Deconnexion
          </a></li>
      </ul>
      </div>
      <img src="../img/menu-btn" alt="Menu hamburger" id="menuHamb">
    </nav>
  </header>
  <script src="../js/hamb.js"></script>