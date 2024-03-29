<?php 

//Partie empechant l'utilisateur non connecter a accéder au contenue (mettre en commentaire pour modifier le code facilement)
require '../fonctionPHP/authentification.php';
forcer_utilisateur_connecte();
//Appel du header
$title = "Ultimate Gestion";
require 'header.php'; 

// récupérer tous les joueurs
require '../fonctionPHP/connexionbd.php';
///Préparation de la requête sans les variables (marqueurs : nominatifs)

//recuperer l'année de la saison actuel
$saisonActuel= $linkpdo->prepare('SELECT max(YEAR( datem)) as saisonactuel FROM `matchs` WHERE score_equipe is NOT null and score_adverse is not null;');
$saisonActuel->execute();
$saison = $saisonActuel->fetch();


//recuperer les années des matchs pour en faire des saisons
$recupAnneeSaison= $linkpdo->prepare('SELECT DISTINCT(YEAR( datem)) as datesaison FROM `matchs` WHERE score_equipe is NOT null and score_adverse is not null;');
 ///Liens entre variables PHP et marqueurs
$recupAnneeSaison->execute();


//recuperer les matchs l'année de la saison choisit
$matchsaison = $linkpdo->prepare('SELECT score_equipe,score_adverse,nom_equipe_adverse,DATE_FORMAT(datem, "%d/%m/%Y") datem, datem as datetrie ,heurem ,img from matchs,adversaire where matchs.id_adversaire = adversaire.id_adversaire AND score_equipe is NOT null and score_adverse is not null ORDER BY datetrie DESC;');
$matchsaison->execute();


?>

<h1 id="Titre-accueil">Match de la saison
                        <!-- <select name="choix_saison" id="choix_saison" required>
                        <?php while ($annee = $recupAnneeSaison->fetch()): ?>
                            <option value="<?php echo htmlspecialchars($annee['datesaison']) ?>"><?php echo htmlspecialchars($annee['datesaison']) ?></option>
                            <?php endwhile; ?>
                        </select> --></h1>
<div class="Container-match">
    <?php while ($match = $matchsaison->fetch()): ?>
    <a class="boutonmodif" href="<?php echo "modifierMatch.php?datem=".$match['datetrie']."&heurem=".$match['heurem']?>">
        <div class="match">
            <div class="Equipe1">
                <img class="LogoEquipe" src="../img/Equipe/TFC_LOGO.png" alt="">
                
            </div>
            <h1>Toulouse Ultimate Club</h1>
                <h1><?php echo htmlspecialchars($match['score_equipe']) ?></h1>

            <div class="SeparationScore">
                <?php if($match['score_equipe'] > $match['score_adverse']) { ?>
                    <h2 style='color: #a0bf53'>Victoire</h2>
                <?php }elseif($match['score_equipe'] < $match['score_adverse']){ ?>
                    <h2 style='color: #ff4b4b'>Défaite</h2>  
                <?php }else{ ?>
                    <h2 style='color: #5a5a5a'>Égalité</h2>  
                <?php } ?>
                <h3 id="datematch"><?php echo htmlspecialchars($match['datem']) ?></h3>
            </div>
                <h1><?php echo htmlspecialchars($match['score_adverse']) ?></h1>
            <h1><?php echo htmlspecialchars($match['nom_equipe_adverse']) ?></h1>
            
            <div class="Equipe2">
                <img class="LogoEquipe" src="../img/Equipe/<?php echo htmlspecialchars($match['img']) ?>" alt="">
            </div>
        </div>
    </a>
    <?php endwhile; ?>

</div>

<?php require 'footer.php'; ?>