<?php

//Partie empechant l'utilisateur non connecter a accéder au contenue (metthe en commentaire pour modifier le code facilement)
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

//partie tableau joueurs
$joueurs = $linkpdo->prepare('SELECT CONCAT(prenom," ", nom) AS affichage_nom, poste_prefere , statut , 
    count(case participer.etre_titulaire when 1 then 1 else null end) as titulaire,
    count(case participer.etre_titulaire when 0 then 1 else null end) as remplacant, 
    AVG(participer.performance) as moynotes,
    SUM(matchs.score_equipe>matchs.score_adverse) as win,
    SUM(matchs.score_equipe<matchs.score_adverse) as loose,
    SUM(matchs.score_equipe=matchs.score_adverse) as draw 
    FROM joueur, matchs, participer 
    WHERE matchs.datem = participer.datem 
    and matchs.heurem = participer.heurem 
    and joueur.numero_licence = participer.numero_licence 
    group by affichage_nom;');

///Liens enthe variables PHP et marqueurs
$victoires->execute();
$defaites->execute();
$nuls->execute();
$joueurs->execute();


///Stockage des résultat

$victoires = $victoires->fetch();
$defaites = $defaites->fetch();
$nuls = $nuls->fetch();
$nbMatchs = $victoires[0] + $defaites[0] + $nuls[0]
  ?>
<div class="winrate">
  <h1>Taux de victoire</h1>

  <div class="progress"></div>

  <script src="../js/circle-progress.min.js"></script>

  <script>
      new CircleProgress('.progress', {
      max: 100,
      value: <?php echo (($victoires[0] + 0.5 * $nuls[0]) / $nbMatchs * 100) ?>,
      textFormat: 'percent',
    });
  </script>
    <p>
    Match total : <?php echo $nbMatchs ?> <br>
    Victoire : <?php echo $victoires[0] ?> <br>
    Défaites : <?php echo $defaites[0] ?> <br>
    Nuls : <?php echo $nuls[0] ?></p>
  </div>


<table id="statjoueur">
  <thead id="colonne">
    <tr>
      <th>Joueurs</th>
      <th>Statut</th>
      <th>Poste préféré</th>
      <th>Total titulaire</th>
      <th>Total remplaçant</th>
      <th>moyenne des évaluations</th>
      <th>pourcentage de matchs gagnés</th>
    </tr>
  </thead>
  <tbody id="donneeJoueur">
    <?php
    while ($result = $joueurs->fetch()):
    ?>
    <tr>
      <td><?php echo htmlspecialchars($result['affichage_nom']); ?></td>
      <td><?php echo htmlspecialchars($result['statut']); ?></td>
      <td><?php echo htmlspecialchars($result['poste_prefere']); ?></td>
      <td><?php echo htmlspecialchars($result['titulaire']); ?></td>
      <td><?php echo htmlspecialchars($result['remplacant']); ?></td>
      <td><?php echo htmlspecialchars(round($result['moynotes'],1)); ?> / 5</td>
      <td>
        <?php
        if (($result['win'] + $result['loose'] + $result['draw']) == 0){
          echo "Aucun match";
      }else{
        $winrate = (($result['win'] + 0.5 * $result['draw']) / ($result['win'] + $result['loose'] + $result['draw']) * 100);
        echo htmlspecialchars(round($winrate,1))." %";
      }
      
      
        ?>
      </td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<script src="../js/winrate.js"></script>

<?php require 'footer.php'; ?>