<?php 

//Partie empechant l'utilisateur non connecter a accéder au contenue (mettre en commentaire pour modifier le code facilement)
require '../fonctionPHP/authentification.php';
forcer_utilisateur_connecte();
//Appel du header
$title = "Saisie Joueur";
require 'header.php'; 
//appel a la method de post d'image
?>

<!--Partie HTML --> 
<html>
		<section class=saisieJoueur>
            <h2 class="cache">Formulaire d'inscription d'un joueur</h2>
            <form action="../fonctionPHP/ajoutJoueur.php" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Inscription d'un joueur</legend>
                    <div>
                        <label for="nom">Nom :</label>
                        <input type="text" name="nom_saisie" id="nom_saisie" placeholder="Ex : Dubois" autofocus required/><br>
        
                        <label for="prenom">Prénom :</label>
                        <input type="text" name="prenom_saisie" id="prenom_saisie" placeholder="Ex : Emile" required/><br>
						
						<label for="photo">Photo :</label>
                        <input type="file" name="photo_saisie" id="photo_saisie" accept="image/png, image/jpeg"/><br>
						
						<label for="numero_licence">Numéro de licence :</label>
                        <input type="text" name="num_licence_saisie" id="num_licence_saisie" placeholder="Ex : 123456789" maxlength="9" required/><br>
						
						<label for="date_naissance">Date de naissance :</label>
                        <input type="date" name="date_naissance_saisie" id="date_naissance_saisie" placeholder="Ex : 21/02/1999" required/><br>
						
						<label for="taille">Taille :</label>
                        <div class="mesure"><input type="number" name="taille_saisie" id="taille_saisie" placeholder="0" min="1" max="400" maxlength="3" required/><p>cm</p></div><br>
						
						<label for="poids">Poids :</label>
                        <div class="mesure"><input type="number" name="poids_saisie" id="poids_saisie" placeholder="0" min="1" max="400" maxlength="3" required/><p>kg</p></div><br>
						
						<label for="poste_prefere">Poste préféré :</label>
                        <select name="poste_saisie" id="poste_saisie" required>
                            <option value="">--Choisissez une option--</option>
                            <option value="Attaquant">Attaquant</option>
                            <option value="Défenseur">Défenseur</option>
                            <option value="Aucun">Aucun</option>
                        </select><br>
						
						<label for="note_perso">Note personnel :</label>
                        <input type="text" name="note_saisie" id="note_saisie" placeholder="Ex : il est efficace" maxlength="150"/><br>
						
						<label for="statut">Status :</label>
                        <select name="statut_saisie" id="statut_saisie" required>
                            <option value="">--Choisissez une option--</option>
                            <option value="Actif">Actif</option>
                            <option value="Blessé">Blessé</option>
                            <option value="Suspendu">Suspendu</option>
                            <option value="Absent">Absent</option>
                        </select><br>
						<div class="bouton_form">
                            <button class="supprimer" type="submit">Effacer</button>
                            <button class="bouton" type="submit">Valider</button>
                        </div>
                    </div>
                </fieldset>
            </form>
         </section>

<?php require 'footer.php'; ?>