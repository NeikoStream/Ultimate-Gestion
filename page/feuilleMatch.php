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
//recuperer les joueurs
$joueurs = $linkpdo->prepare('SELECT * from joueur');
$joueurs->execute();

//recuperer les donnée du match pour les afficher
$idEquipe = $linkpdo->prepare('SELECT nom_equipe_adverse, matchs.id_adversaire,etre_domicile,score_equipe,score_adverse from matchs , adversaire where datem = :datem and heurem= :heurem and matchs.id_adversaire = adversaire.id_adversaire;');
$idEquipe->execute(array('datem' => $datem , 'heurem' => $heurem));
$equipeAdverse = $idEquipe->fetch();



?>

<!--Partie HTML --> 

<html>
        
		<section class=saisieJoueur>
            <h2 class="cache">Formulaire de modification d'un match</h2>
            <form action="<?php echo "../fonctionPHP/editfeuilleMatch.php?datem=".$datem."&heurem=".$heurem?>" method="post">
                <fieldset>
                    <legend>Modification d'un match</legend>
                    <div class="choix-titulaire">
                        <p><strong>Choisisez les titulaires (7)</strong></p>
                        
                        <?php while ($joueur = $joueurs->fetch()): ?>
                        <input class="single-checkbox"type="checkbox" name="joueur" value="<?php echo htmlspecialchars($joueur['numero_licence']) ?>"><?php echo htmlspecialchars($joueur['nom']." ".$joueur['prenom']) ?> <br>
                        <?php endwhile; ?>
                    </div>
                </fieldset>
            </form>
         </section>

         
	</body>
</html>