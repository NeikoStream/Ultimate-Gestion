<?php 

//Partie empechant l'utilisateur non connecter a accéder au contenue (mettre en commentaire pour modifier le code facilement)
require '../fonctionPHP/authentification.php';
forcer_utilisateur_connecte();
//Appel du header
$title = "Joueurs";
require 'header.php'; 

// METHODE avec PDO
// récupérer tous les matchs

require '../fonctionPHP/connexionbd.php';
///Préparation de la requête sans les variables (marqueurs : nominatifs)
$query= $linkpdo->prepare('SELECT * FROM joueur');
 ///Liens entre variables PHP et marqueurs
$query->execute();

?>
    <h2 class="titre_joueurs">Liste des joueurs</h2>
    <li class="listejoueurs">
        <?php while($row = $query->fetch()): ?>
            <a class="joueur" href="modifierJoueur.php">
                <ul>
                    <img class="photo_joueur" src=<?php echo htmlspecialchars($row['photo']); ?> alt="photo de <?php echo htmlspecialchars($row['prenom']); ?>
                    <?php echo htmlspecialchars($row['nom']); ?>" width="100">
                    <h3><?php echo htmlspecialchars($row['prenom']); ?> <?php echo htmlspecialchars($row['nom']); ?></h3>
                    <p class="statut_joueur"><?php echo htmlspecialchars($row['statut']); ?></p>
                    <br/>
                    <p class="info_joueurs">Poste préféré : <?php echo htmlspecialchars($row['poste_prefere']); ?></p>
                    <p class="info_joueurs">Taille : <?php echo htmlspecialchars($row['taille']); ?> cm</p>
                    <p class="info_joueurs">Poids : <?php echo htmlspecialchars($row['poids']); ?> kg</p>
                    <p class="info_joueurs">Date de naissance : <?php echo htmlspecialchars($row['date_naissance']); ?></p>
                    <p class="info_joueurs">Commentaire</p>
                    <div class="note"><p><?php echo htmlspecialchars($row['note_perso']); ?></p></div>
                    <br/>
                    <p class="n_licence"><?php echo htmlspecialchars($row['numero_licence']); ?></p>
                </ul>
            </a>
        <?php endwhile; ?>
        <ul class="ajoutJoueur joueur"><a href="saisieJoueur.php">Ajouter un joueur</a></ul>
    </li>
</body>
</html>