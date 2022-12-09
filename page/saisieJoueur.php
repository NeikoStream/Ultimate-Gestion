<?php 

//Partie empechant l'utilisateur non connecter a accéder au contenue (mettre en commentaire pour modifier le code facilement)
require '../fonctionPHP/authentification.php';
forcer_utilisateur_connecte();
//Appel du header
$title = "Saisie Joueur";
require 'header.php'; ?>

<!--Partie HTML --> 
<html>
		<section class="joueur formul">
            <h2 class="cache">Formulaire d'inscription d'un joueur</h2>
            <form action="ajoutJoueur.php" method="post">
                <fieldset>
                    <legend>Inscription d'un joueur</legend>
                    <div class="infos">
                        <label for="user_nom">Nom :</label>
                        <input type="text" name="nom_saisie" id="nom_saisie" placeholder="Ex : Dubois" autofocus required/><br>
        
                        <label for="user_prenom">Prénom :</label>
                        <input type="text" name="prenom_saisie" id="prenom_saisie" placeholder="Ex : Emile" required/><br>
						
						<label for="user_prenom">Photo :</label>
                        <input type="text" name="photo_saisie" id="photo_saisie" required/><br>
						
						<label for="user_prenom">Numéro de licence :</label>
                        <input type="text" name="num_licence_saisie" id="num_licence_saisie" placeholder="Ex : TU678UO7TOIYYTHU" required/><br>
						
						<label for="user_prenom">Date de naissance :</label>
                        <input type="text" name="date_naissance_saisie" id="date_naissance_saisie" placeholder="Ex : 21/02/1999" required/><br>
						
						<label for="user_prenom">Taille :</label>
                        <input type="text" name="taille_saisie" id="taille_saisie" placeholder="Ex : 170" required/><br>
						
						<label for="user_prenom">Poids :</label>
                        <input type="text" name="poids_saisie" id="poids_saisie" placeholder="Ex : 50 kg" required/><br>
						
						<label for="user_prenom">Poste préféré :</label>
                        <input type="text" name="poste_pref_saisie" id="poste_pref_saisie" placeholder="Ex : remplacant" /><br>
						
						<label for="user_prenom">Note personnel :</label>
                        <input type="text" name="note_saisie" id="note_saisie" placeholder="Ex : il est efficace" /><br>
						
						<label for="user_prenom">Status :</label>
                        <input type="text" name="status_saisie" id="statuts_saisie" placeholder="Ex : Absent" required/><br>
					
						<button type="reset">Effacer</button>
						<button type="submit">Valider</button>
                    </div>
                </fieldset>
            </form>
         </section>
	</body>
</html>