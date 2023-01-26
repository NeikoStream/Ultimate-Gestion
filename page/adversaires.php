<?php 

//Partie empechant l'utilisateur non connecter a accéder au contenue (mettre en commentaire pour modifier le code facilement)
require '../fonctionPHP/authentification.php';
forcer_utilisateur_connecte();
//Appel du header
$title = "Adversaires";
require 'header.php'; 

// METHODE avec PDO
// récupérer tous les joueurs
require '../fonctionPHP/connexionbd.php';
///Préparation de la requête sans les variables (marqueurs : nominatifs)
$query= $linkpdo->prepare('SELECT * FROM adversaire');
 ///Liens entre variables PHP et marqueurs
$query->execute();

//Taux de victoire adversaire
$victory= $linkpdo->prepare('SELECT SUM(matchs.score_equipe>matchs.score_adverse) as win,
    SUM(matchs.score_equipe<matchs.score_adverse) as loose,
    SUM(matchs.score_equipe=matchs.score_adverse) as draw 
    FROM matchs
    WHERE matchs.id_adversaire = :id_adversaire');

?>
    <h2 class="titre">Liste des équipes adverses</h2>
    <ul class="liste">
            <a class="carte" href="saisieEquipe.php"><ul class="ajoutAdversaire">Ajouter une équipe adverse</ul></a>
        <?php while ($row = $query->fetch()):
            $idequipe = $row['id_adversaire'];
            $victory->execute(array("id_adversaire" => $idequipe));
            $stat = $victory ->fetch();

            $victoires = $stat['win'];
            $defaites = $stat['loose'];
            $nuls = $stat['draw'];
            $nbMatchs = $victoires + $defaites + $nuls
            ?>

            <a class="carte" href="<?php echo "modifierEquipe.php?idequipe=".$idequipe?>">
                <li>
                    <img class="photo_joueur" src="../img/Equipe/<?php echo $row['img']; ?>" alt="photo de <?php echo htmlspecialchars($row['nom_equipe_adverse']); ?>" width="100">
                    <h3><?php echo htmlspecialchars($row['nom_equipe_adverse']); ?></h3>
                    <hr size="1px" noshade width="100%">
                    <?php 
                    if(isset($victoires, $defaites, $nuls)){ echo '<h4 class="dataAdverse"> Nombre de rencontres : '.$nbMatchs."<h4>"; }
                    ?>
                    <h4><?php if(isset($victoires, $defaites, $nuls)){ echo "Taux de victoire : ".(($victoires+ 0.5 * $nuls) / $nbMatchs * 100)." %";}else{ echo "Pas de matchs";} ?></h4>
                    <?php if(isset($victoires, $defaites, $nuls)){ echo '<h4 class="dataAdverse"> V : '.$victoires."| D : ".$defaites."| N : ".$nuls."<h4>"; } ?>
                </li>
            </a>
        <?php endwhile; ?>
    </ul>

<?php require 'footer.php'; ?>