<?php 

//Partie empechant l'utilisateur non connecter a accéder au contenue (mettre en commentaire pour modifier le code facilement)
require '../fonctionPHP/authentification.php';
forcer_utilisateur_connecte();
//Appel du header
$title = "Matchs";
require 'header.php'; 

// METHODE avec PDO
// récupérer tous les matchs

require '../fonctionPHP/connexionbd.php';

    ///Préparation de la requête sans les variables (marqueurs : nominatifs)

    $requete = $linkpdo->prepare('SELECT datem,heurem,nom_equipe_adverse FROM matchs');
 
    ///Liens entre variables PHP et marqueurs
   $requete->execute();

   
?>
    <h2>Liste des matchs</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Heure</th>
                <th>Adversaires</th>
            </tr>
        </thead>
        <tbody>
            <?php while($result = $requete->fetch()): ?>
            <tr>
                <td><?php echo htmlspecialchars($result['datem']); ?></td>
                <td><?php echo htmlspecialchars($result['heurem']); ?></td>
                <td><?php echo htmlspecialchars($result['nom_equipe_adverse']); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <button>Ajouter un match</button>
</body>
</html>