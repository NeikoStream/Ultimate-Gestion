<?php 

//Partie empechant l'utilisateur non connecter a accéder au contenue (mettre en commentaire pour modifier le code facilement)
require '../fonctionPHP/authentification.php';
forcer_utilisateur_connecte();
//Appel du header
$title = "modifier Match";
require 'header.php'; 
$heurem = htmlspecialchars($_GET["heurem"]);
$datem = htmlspecialchars($_GET["datem"]);

// connexionBD
require '../fonctionPHP/connexionbd.php';
//recuperer les equipes déjà rencontrer
$adversaire = $linkpdo->prepare('SELECT * from adversaire');
$adversaire->execute();

$idEquipe = $linkpdo->prepare('SELECT nom_equipe_adverse, matchs.id_adversaire,etre_domicile from matchs , adversaire where datem = :datem and heurem= :heurem and matchs.id_adversaire = adversaire.id_adversaire;');
$idEquipe->execute(array('datem' => $datem , 'heurem' => $heurem));
$equipeAdverse = $idEquipe->fetch();
?>

<!--Partie HTML --> 
<html>
		<section class=saisieJoueur>
            <h2 class="cache">Formulaire de modification d'un match</h2>
            <form action="<?php echo "../fonctionPHP/editMatch.php?datem=".$datem."&heurem=".$heurem?>" method="post">
                <fieldset>
                    <legend>Modification d'un match</legend>
                    <div>
                        <label for="datem">Date du match :</label>
                        <input type="date" name="datem_saisie" id="datem_saisie" placeholder="Ex : 21/02/1999" value="<?php echo $datem?>" required/><br>

                        <label for="heurem">Heure du match :</label>
                        <input type="time" name="heurem_saisie" id="heurem_saisie" placeholder="Ex : 14:30" value="<?php echo $heurem?>" required/><br>

                        
                        <label for="nom_equipe_adverse">Nom de l'équipe adverse :</label>

                          
                        
                        <select name="equipe" id="choix_equipe" required>
                            <option value="<?php echo htmlspecialchars($equipeAdverse['id_adversaire']) ?>">[ <?php echo htmlspecialchars($equipeAdverse['nom_equipe_adverse']) ?> ]</option>
                        <?php while ($equipe = $adversaire->fetch()): ?>
                            <option value="<?php echo htmlspecialchars($equipe['id_adversaire']) ?>"><?php echo htmlspecialchars($equipe['nom_equipe_adverse']) ?></option>
                            <?php endwhile; ?>
                        </select>
                        
                        <div class="checkbox">
                            <input type="checkbox" name="etre_domicile_saisie" id="etre_domicile_saisie" <?php if ($equipeAdverse['etre_domicile']) {
                            echo "checked"; } ?>/><p>Se déroule à domicile</p> <br>


                        </div>  
                        
						<button type="submit">Modifier</button>
                        <a href="<?php echo "../fonctionPHP/deleteMatch.php?datem=".$datem."&heurem=".$heurem?>">Supprimer</a>
                    </div>
                </fieldset>
            </form>
         </section>
	</body>
</html>