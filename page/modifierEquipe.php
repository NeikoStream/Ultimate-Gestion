<?php
//Partie empechant l'utilisateur non connecter a accéder au contenue (mettre en commentaire pour modifier le code facilement)
require '../fonctionPHP/authentification.php';
forcer_utilisateur_connecte();
//Appel du header
$title = "Modifier equipe";
require 'header.php'; 
//appel a la method de recuperation du parmettre dans l'url
$idequipe = htmlspecialchars($_GET["idequipe"]);

// METHODE avec PDO
// récupérer le joueur via son numero de licence
require '../fonctionPHP/connexionbd.php';
///Préparation de la requête sans les variables (marqueurs : nominatifs)
$query= $linkpdo->prepare('SELECT * FROM adversaire WHERE id_adversaire = :id_adversaire');
 ///Liens entre variables PHP et marqueurs
$query->execute(array('id_adversaire' => $idequipe));
$equipe = $query->fetch()
?>

<!--Partie HTML --> 
<html>
		<section class=saisieJoueur>
            <h2 class="cache">Formulaire d'ajout d'une équipe adverse</h2>
            <form action="<?php echo "../fonctionPHP/editEquipe.php?idEquipe=".$idequipe?>" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Modifier une équipe adverse</legend>
                    <div>
                        
                        <label for="nom_equipe_adverse">Nom de l'équipe adverse :</label>
                        <input type="text" name="nom_equipe_adverse_saisie" id="nom_equipe_adverse_saisie" placeholder="Ex : Les frisbees" maxlength="100" value="<?php echo $equipe["nom"]?>" required/><br>

                        <label for="photo">Photo :</label>
                        <input type="file" name="photo_saisie" id="photo_saisie" accept="image/png, image/jpeg" value="<?php echo $equipe["img"]?>"/><br>
                        
						<button type="submit">Modifier</button>
                        <a href="<?php echo "../fonctionPHP/deleteEquipe.php?idEquipe=".$idequipe?>">Supprimer</a>
                    </div>
                </fieldset>
            </form>
         </section>
	</body>
</html>
