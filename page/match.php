<?php 

//Partie empechant l'utilisateur non connecter a accéder au contenue (mettre en commentaire pour modifier le code facilement)
require '../fonctionPHP/authentification.php';
forcer_utilisateur_connecte();
//Appel du header
$title = "Matchs";
require 'header.php'; 

// récupérer tous les matchs
// connexion à la base de données
 $db_username = 'u161682765_ultimatebd';
 $db_password = '7>vEV#s9t';
 $db_name = 'u161682765_ultimate';
 $db_host = '153.92.220.151:3306';
 $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
 or die('could not connect to database');
//require '../fonctionPHP/verification.php';
$query= mysqli_query($db,"SELECT datem,heurem,nom_equipe_adverse FROM matchs");

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
            <?php while($row = mysqli_fetch_assoc($query)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['datem']); ?></td>
                <td><?php echo htmlspecialchars($row['heurem']); ?></td>
                <td><?php echo htmlspecialchars($row['nom_equipe_adverse']); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <button>Ajouter un match</button>*
</body>
</html>