<?php 

//Partie empechant l'utilisateur non connecter a accéder au contenue (mettre en commentaire pour modifier le code facilement)
require '../fonctionPHP/authentification.php';
forcer_utilisateur_connecte();
//Appel du header
$title = "Saisie Match";
require 'header.php'; 


// connexionBD
require '../fonctionPHP/connexionbd.php';
//recuperer les equipes déjà rencontrer
$adversaire = $linkpdo->prepare('SELECT * from adversaire');
$adversaire->execute();

?>

<!--Partie HTML --> 
<html>
		<section class=saisieJoueur>
            <h2 class="cache">Formulaire d'ajout d'un match</h2>
            <form action="../fonctionPHP/ajoutMatch.php" method="post">
                <fieldset>
                    <legend>Ajout d'un match</legend>
                    <div>
                        <label for="datem">Date du match :</label>
                        <input type="date" name="datem_saisie" id="datem_saisie" placeholder="Ex : 21/02/1999" required/><br>

                        <label for="heurem">Heure du match :</label>
                        <input type="time" name="heurem_saisie" id="heurem_saisie" placeholder="Ex : 14:30" required/><br>

                        
                        <label for="nom_equipe_adverse">Nom de l'équipe adverse :</label>

                          
                        
                        <select name="equipe" id="choix_equipe" required>
                        <?php while ($equipe = $adversaire->fetch()): ?>
                            <option value="<?php echo htmlspecialchars($equipe['id_adversaire']) ?>"><?php echo htmlspecialchars($equipe['nom_equipe_adverse']) ?></option>
                            <?php endwhile; ?>
                        </select>
                        
                        <div class="checkbox">
                            <input type="checkbox" name="etre_domicile_saisie" id="etre_domicile_saisie"/><p>Se déroule à domicile</p> <br>
                        </div>  
                        
						<button type="reset">Effacer</button>
						<button type="submit">Valider</button>
                    </div>
                </fieldset>
            </form>
         </section>
	</body>
</html>