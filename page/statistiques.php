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
</div>

<p>prc Victoire : <?php echo (($victoires[0] + 0.5*$nuls[0]) / $nbMatchs * 100) ?></p>
<p>Victoire : <?php echo $victoires[0]?></p>
<p>Défaites : <?php echo $defaites[0]?></p>
<p>Nuls : <?php echo $nuls[0]?></p>







<script>
function createJauge(elem) {
  if (elem) {
    // on commence par un clear
    while (elem.firstChild) {
      elem.removeChild(elem.firstChild);
    }
    // création des éléments
    var oMask  = document.createElement('DIV');
    var oBarre = document.createElement('DIV');
    var oSup50 = document.createElement('DIV');
    // affectation des classes
    oMask.className  = 'progress-masque';
    oBarre.className = 'progress-barre';
    oSup50.className = 'progress-sup50';
    // construction de l'arbre
    oMask.appendChild(oBarre);
    oMask.appendChild(oSup50);
    elem.appendChild(oMask);
  }
  return elem;
}

function initJauge(elem) {
  var oBarre;
  var angle;
  var valeur;
  //
  createJauge( elem);
  oBarre = elem.querySelector('.progress-barre');
  valeur = elem.getAttribute('data-value');
  valeur = valeur ? valeur * 1 : 0;
  elem.setAttribute('data-value', valeur.toFixed(1));
  angle = 360 * valeur / 100;
  if (oBarre) {
    oBarre.style.transform = 'rotate(' + angle + 'deg)';
  }
}

// Initialisation après chargement du DOM
document.addEventListener('DOMContentLoaded', function () {
  var oJauges = document.querySelectorAll('.progress-circle');
  var i, nb = oJauges.length;
  for (i = 0; i < nb; i += 1) {
    initJauge(oJauges[i]);
  }
});
</script>