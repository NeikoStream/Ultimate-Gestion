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
    $joueurs = $linkpdo->prepare('SELECT nom, prenom , poste_prefere , statut , count(participer.etre_titulaire = 1) as titulaire, count(participer.etre_titulaire = 0) as remplacant, AVG(participer.performance) as moynotes,COUNT(matchs.score_equipe>matchs.score_adverse) as win,COUNT(matchs.score_equipe<matchs.score_adverse) as loose,COUNT(matchs.score_equipe=matchs.score_adverse) as draw FROM joueur, matchs, participer WHERE matchs.datem = participer.datem and matchs.heurem = participer.heurem and joueur.numero_licence = participer.numero_licence');
    $winjoueur = $linkpdo->prepare('SELECT COUNT(*) 
    FROM joueur, matchs, participer 
    WHERE joueur.numero_licence = :numlic 
    and matchs.datem = participer.datem 
    and matchs.heurem = participer.heurem 
    and joueur.numero_licence = participer.numero_licence
    and matchs.score_equipe>matchs.score_adverse;');
    ///Liens enthe variables PHP et marqueurs
   $victoires->execute();
   $defaites->execute();
   $nuls->execute();
   $joueurs->execute();
   

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
  
  
  while($result = $joueurs->fetch()): 
  ?>
            <tr>
                <td><?php echo htmlspecialchars($result['prenom']).' '.htmlspecialchars($result['nom']);?></td>
                <td><?php echo htmlspecialchars($result['statut']); ?></td>
                <td><?php echo htmlspecialchars($result['poste_prefere']); ?></td>
                <td><?php echo htmlspecialchars($result['titulaire']); ?></td>
                <td><?php echo htmlspecialchars($result['remplacant']); ?></td>
                <td><?php echo htmlspecialchars($result['moynotes']); ?></td>
                <td>
                <?php 
                  $winrate = (($result['win'] + 0.5*$result['draw'])/($result['win']+$result['loose']+$result['draw']) * 100);
                  echo htmlspecialchars($winrate); 
                  ?>
                </td>
            </tr>
            <?php endwhile; ?>
  </tbody>
</table>

<script src="../js/winrate.js"></script>