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
$query= $linkpdo->prepare('SELECT *,DATE_FORMAT(date_naissance, "%d/%m/%Y") datej FROM joueur ORDER by prenom, nom');
 ///Liens entre variables PHP et marqueurs
$query->execute();

?>
    <h2 class="titre">Liste des joueurs</h2>
    <ul class="liste">
            <a class="carte" href="saisieJoueur.php"><li class="ajoutJoueur"><p>Ajouter un joueur</p></li></a>
        <?php while ($row = $query->fetch()):
            $numlic = $row['numero_licence'];
            ?>

            <a class="carte" href="<?php echo "modifierJoueur.php?lic=".$numlic?>">
                <li>
                    <img class="photo_joueur" src="../img/Joueurs/<?php echo $row['photo']; ?>" alt="photo de <?php echo htmlspecialchars($row['prenom']); ?>
                    <?php echo htmlspecialchars($row['nom']); ?>" width="100">
                    <h3><?php echo htmlspecialchars($row['prenom']); ?> <?php echo htmlspecialchars($row['nom']); ?></h3>
                    <p class="statut"><?php echo htmlspecialchars($row['statut']); ?></p>                    
                    <p class="info_joueurs">Poste préféré : <?php echo htmlspecialchars($row['poste_prefere']); ?></p>
                    <p class="info_joueurs">Taille : <?php echo htmlspecialchars($row['taille']); ?> cm</p>
                    <p class="info_joueurs">Poids : <?php echo htmlspecialchars($row['poids']); ?> kg</p>
                    <p class="info_joueurs">Date de naissance : <?php echo htmlspecialchars($row['datej']); ?></p>
                    <p class="info_joueurs">Commentaire</p>
                    <div class="note">
                        <p>
                            <?php 
                            if($row['note_perso'] == null){
                                echo "Pas de commentaire.";
                            }else{
                                echo htmlspecialchars($row['note_perso']); 
                            }
                            
                            ?>
                        </p>
                    </div>   
                    <p class="n_licence"><?php echo htmlspecialchars($row['numero_licence']); ?></p>
        </li>
            </a>
        <?php endwhile; ?>
    </ul>

<?php require 'footer.php'; ?>