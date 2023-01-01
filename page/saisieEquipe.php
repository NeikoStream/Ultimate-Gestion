<?php 

//Partie empechant l'utilisateur non connecter a accéder au contenue (mettre en commentaire pour modifier le code facilement)
require '../fonctionPHP/authentification.php';
forcer_utilisateur_connecte();
//Appel du header
$title = "Saisie equipe";
require 'header.php'; 
?>

<!--Partie HTML --> 
<html>
		<section class=saisieJoueur>
            <h2 class="cache">Formulaire d'ajout d'une équipe adverse</h2>
            <form action="../fonctionPHP/ajoutEquipe.php" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Ajout d'une équipe adverse</legend>
                    <div>
                        
                        <label for="nom_equipe_adverse">Nom de l'équipe adverse :</label>
                        <input type="text" name="nom_equipe_adverse_saisie" id="nom_equipe_adverse_saisie" placeholder="Ex : Les frisbees" maxlength="100" required/><br>

                        <label for="photo">Photo :</label>
                        <input type="file" name="photo_saisie" id="photo_saisie" accept="image/png, image/jpeg"/><br>
                        
						<button type="reset">Effacer</button>
						<button type="submit">Valider</button>
                    </div>
                </fieldset>
            </form>
         </section>
	</body>
</html>