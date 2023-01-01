<?php 

//Partie empechant l'utilisateur non connecter a accéder au contenue (mettre en commentaire pour modifier le code facilement)
require '../fonctionPHP/authentification.php';
forcer_utilisateur_connecte();
//Appel du header
$title = "Joueurs";
require 'header.php'; 

// METHODE avec PDO
// récupérer tous les joueurs
require '../fonctionPHP/connexionbd.php';
///Préparation de la requête sans les variables (marqueurs : nominatifs)
$query= $linkpdo->prepare('SELECT * FROM adversaire');
 ///Liens entre variables PHP et marqueurs
$query->execute();

?>
    <h2 class="titre_joueurs">Liste des équipes adverses</h2>
    <li class="listejoueurs">
            <a class="joueur" href="saisieEquipe.php"><ul class="ajoutJoueur">Ajouter une équipe adverse</ul></a>
        <?php while ($row = $query->fetch()):
            $idequipe = $row['id_adversaire'];
            ?>

            <a class="joueur" href="<?php echo "modifierEquipe.php?idequipe=".$idequipe?>">
                <ul>
                    <img class="photo_joueur" src="../img/<?php echo $row['img']; ?>" alt="photo de <?php echo htmlspecialchars($row['nom']); ?>" width="100">
                    <h3><?php echo htmlspecialchars($row['nom']); ?></h3>
                </ul>
            </a>
        <?php endwhile; ?>
    </li>
</body>
</html>