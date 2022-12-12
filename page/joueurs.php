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
    <h2>Liste des joueurs</h2>
    <li class="listejoueurs">
        <?php while($row = $query->fetch()): ?>
        <ul class="joueur">
            <a href="modifierJoueur.php">
                <img class=photo_joueurs src=<?php echo htmlspecialchars($row['photo']); ?> alt="photo de <?php echo htmlspecialchars($row['prenom']); ?>
                <?php echo htmlspecialchars($row['nom']); ?>" width="100">
                <p><?php echo htmlspecialchars($row['prenom']); ?><?php echo htmlspecialchars($row['nom']); ?></p>
                <p><?php echo htmlspecialchars($row['numero_licence']); ?></p>
                <p><?php echo htmlspecialchars($row['date_naissance']); ?></p>
                <p><?php echo htmlspecialchars($row['taille']); ?> cm</p>
                <p><?php echo htmlspecialchars($row['poids']); ?> kg</p>
                <p><?php echo htmlspecialchars($row['poste_prefere']); ?></p>
                <p><?php echo htmlspecialchars($row['note_perso']); ?></p>
                <p><?php echo htmlspecialchars($row['statut']); ?></p>
            </a>
        </ul>
        <?php endwhile; ?>
        <ul class="ajoutJoueur joueur"><a href="saisieJoueur.php">Ajouter un joueur</a></ul>
    </li>
</body>
</html>