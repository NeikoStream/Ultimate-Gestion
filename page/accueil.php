<?php 

//Partie empechant l'utilisateur non connecter a accéder au contenue (mettre en commentaire pour modifier le code facilement)
require '../fonctionPHP/authentification.php';
forcer_utilisateur_connecte();
//Appel du header
$title = "Accueil";
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
$matchsaison = $linkpdo->prepare("SELECT * from matchs where score_equipe is NOT null and score_adverse is not null;");
$matchsaison->execute();


?>

<h1 id="Titre-accueil">Match de la saison
                        <select name="choix_saison" id="choix_saison" required>
                        <?php while ($annee = $recupAnneeSaison->fetch()): ?>
                            <option value="<?php echo htmlspecialchars($annee['datesaison']) ?>"><?php echo htmlspecialchars($annee['datesaison']) ?></option>
                            <?php endwhile; ?>
                        </select></h1>
<div class="Container-match">
    <?php while ($match = $matchsaison->fetch()): ?>
    <div class="match">
        <div class="Equipe1">
            <img class="LogoEquipe" src="../img/Equipe/TFC_LOGO.png" alt="">
            
        </div>
        <div class="score">
            <h1><?php echo htmlspecialchars($match['score_equipe']) ?></h1>
        </div>

        <div class="SeparationScore">
            <button>Voir en détail</button>
            <h2 id="datematch"><?php echo htmlspecialchars($match['datem']) ?></h2>
        </div>
        <div class="score">
            <h1><?php echo htmlspecialchars($match['score_adverse']) ?></h1>
        </div>

        
        <div class="Equipe2">
            <img class="LogoEquipe" src="../img/Equipe/TFC_LOGO.png" alt="">
        </div>
    </div>
    <?php endwhile; ?>

</div>


</body>
</html>