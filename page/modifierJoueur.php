<?php
//Partie empechant l'utilisateur non connecter a accéder au contenue (mettre en commentaire pour modifier le code facilement)
require '../fonctionPHP/authentification.php';
forcer_utilisateur_connecte();
//Appel du header
$title = "Saisie Joueur";
require 'header.php'; 
//appel a la method de post d'image
$numlic = htmlspecialchars($_GET["var1"]);

// METHODE avec PDO
// récupérer le joueur via son numero de licence
require '../fonctionPHP/connexionbd.php';
///Préparation de la requête sans les variables (marqueurs : nominatifs)
$query= $linkpdo->prepare('SELECT * FROM joueur WHERE numero_licence = :numlic');
 ///Liens entre variables PHP et marqueurs
$query->execute(array('numlic' => $numlic));
$joueurs = $query->fetch()
?>

<!--Partie HTML --> 
<html>
		<section class=saisieJoueur>
            <h2 class="cache">Formulaire d'inscription d'un joueur</h2>
            <form action="../fonctionPHP/editJoueur.php" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Inscription d'un joueur</legend>
                    <div>
                        <label for="nom">Nom :</label>
                        <input type="text" name="nom_saisie" id="nom_saisie" placeholder="Ex : Dubois" value="<?php echo $joueurs["nom"]?>" autofocus required/><br>
        
                        <label for="prenom">Prénom :</label>
                        <input type="text" name="prenom_saisie" id="prenom_saisie" placeholder="Ex : Emile" value="<?php echo $joueurs["prenom"]?>" required/><br>
						
						<label for="photo">Photo :</label>
                        <input type="file" name="photo_saisie" id="photo_saisie" value="<?php echo $joueurs["photo"]?>" accept="image/png, image/jpeg"/><br>
						
						<label for="numero_licence">Numéro de licence :</label>
                        <input type="text" name="num_licence_saisie" id="num_licence_saisie" placeholder="Ex : 123456789" value="<?php echo $joueurs["numero_licence"]?>" maxlength="9" required/><br>
						
						<label for="date_naissance">Date de naissance :</label>
                        <input type="date" name="date_naissance_saisie" id="date_naissance_saisie" placeholder="Ex : 21/02/1999" value="<?php echo $joueurs["date_naissance"]?>" required/><br>
						
						<label for="taille">Taille :</label>
                        <div class="mesure"><input type="number" name="taille_saisie" id="taille_saisie" placeholder="0" min="1" max="400" maxlength="3" value="<?php echo $joueurs["taille"]?>" required/><p>cm</p></div><br>
						
						<label for="poids">Poids :</label>
                        <div class="mesure"><input type="number" name="poids_saisie" id="poids_saisie" placeholder="0" min="1" max="400" maxlength="3" value="<?php echo $joueurs["poids"]?>" required/><p>kg</p></div><br>
						
						<label for="poste_prefere">Poste préféré :</label>
                        <select name="poste_saisie" id="poste_saisie" required>
                            <option value="<?php echo $joueurs["poste_prefere"]?>">[<?php echo $joueurs["poste_prefere"]?>]</option>
                            <option value="Attaquant">Attaquant</option>
                            <option value="Défenseur">Défenseur</option>
                            <option value="Aucun">Aucun</option>
                        </select><br>
						
						<label for="note_perso">Note personnel :</label>
                        <input type="text" name="note_saisie" id="note_saisie" placeholder="Ex : il est efficace" value="<?php echo $joueurs["note_perso"]?>" maxlength="150"/><br>
						
						<label for="statut">Status :</label>
                        <select name="statut_saisie" id="statut_saisie" required>
                            <option value="<?php echo $joueurs["statut"]?>">[<?php echo $joueurs["statut"]?>]</option>
                            <option value="Actif">Actif</option>
                            <option value="Blessé">Blessé</option>
                            <option value="Suspendu">Suspendu</option>
                            <option value="Absent">Absent</option>
                        </select><br>
						<button type="submit">Modifier</button>
						<button type="submit">Supprimer</button>
                    </div>
                </fieldset>
            </form>
         </section>
	</body>
</html>




?>