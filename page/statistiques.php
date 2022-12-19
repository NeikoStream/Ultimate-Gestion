<?php 

//Partie empechant l'utilisateur non connecter a accéder au contenue (mettre en commentaire pour modifier le code facilement)
require '../fonctionPHP/authentification.php';
forcer_utilisateur_connecte();
//Appel du header
$title = "Statistiques";
require 'header.php'; 

// METHODE avec PDO
// récupérer tous les matchs

require '../fonctionPHP/connexionbd.php';

    ///Préparation de la requête sans les variables (marqueurs : nominatifs)

    $victoires = $linkpdo->prepare('SELECT COUNT(*) FROM `matchs` WHERE score_equipe > score_adverse');
    $defaites = $linkpdo->prepare('SELECT COUNT(*) FROM `matchs` WHERE score_equipe < score_adverse');
    $nuls = $linkpdo->prepare('SELECT COUNT(*) FROM `matchs` WHERE score_equipe = score_adverse');
 
    ///Liens entre variables PHP et marqueurs
   $victoires->execute();
   $defaites->execute();
   $nuls->execute();

   ///Stockage des résultat

   $victoires = $victoires->fetch();
   $defaites = $defaites->fetch();
   $nuls = $nuls->fetch();
    $nbMatchs = $victoires[0]+$defaites[0]+$nuls[0]
?>
<div class="winrate">
    <div class="progress-circle" data-value="<?php echo (($victoires[0] + 0.5*$nuls[0]) / $nbMatchs * 100) ?>"></div>

<p>Victoire : <?php echo $victoires[0]?> Défaites : <?php echo $defaites[0]?> Nuls : <?php echo $nuls[0]?></p>
</div>

<script src="../js/winrate.js"></script>