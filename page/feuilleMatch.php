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
//recuperer les joueurs qui ne participe pas
$joueurs = $linkpdo->prepare('SELECT DISTINCT joueur.numero_licence,joueur.nom,joueur.prenom from joueur where joueur.numero_licence not in (SELECT joueur.numero_licence from joueur,participer WHERE participer.datem = :datem AND participer.heurem = :heurem AND participer.numero_licence = joueur.numero_licence);');
$joueurs->execute(array('datem' => $datem , 'heurem' => $heurem));

//recuperer les participant d'un match
$paticipants = $linkpdo->prepare('SELECT participer.datem,participer.heurem ,joueur.numero_licence,joueur.nom,joueur.prenom from joueur,participer where participer.datem = :datem AND participer.heurem = :heurem AND joueur.numero_licence = participer.numero_licence;');
$paticipants->execute(array('datem' => $datem , 'heurem' => $heurem));

//preparation de la requete d'ajout d'un joueur a un match
$addplayer = $linkpdo->prepare('INSERT INTO participer (numero_licence,datem, heurem) VALUES (:numero_licence, :datem, :heurem)');


$deleteplayer = $linkpdo->prepare('DELETE from participer where numero_licence = :numero_licence AND datem = :datem AND heurem = :heurem');
?>

<!--Partie HTML --> 

<html>
        
		<section class=saisieJoueur>
            <h2 class="cache">Feuille de match</h2>
            <form action="#" method="post">
            <fieldset>
                <legend>Joueurs</legend>
                <table>
                    <thead>
                        <tr>
                            <th>NumLicence</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th><input type="submit" class="button1" name="Actualiser" value="Actualiser"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 0; 
                            while ($joueur = $joueurs->fetch()):
                            ?>
                        <tr>
                            <td><?php echo htmlspecialchars($joueur['numero_licence']) ?></td>
                            <td><?php echo htmlspecialchars($joueur['nom']) ?></td>
                            <td><?php echo htmlspecialchars($joueur['prenom']) ?></td>
                            <td><input type="submit" name="add<?php echo $i?>" value="Ajouter"></td>
                        </tr>
                        <?php
                        if(isset($_POST['add'.$i])){
                            $addplayer->execute(array('numero_licence' =>$joueur['numero_licence'] ,'datem' => $datem , 'heurem' => $heurem));
                        }
                            $i++;
                         endwhile; ?>
                    </tbody>
                </table>
            </fieldset>

            <fieldset>
                <legend>Participants</legend>
                <table>
                    <thead>
                        <tr>
                            <th>NumLicence</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th><input type="submit" class="button1" name="Actualiser" value="Actualiser"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 0; 
                        while ($paticipant = $paticipants->fetch()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($paticipant['numero_licence']) ?></td>
                            <td><?php echo htmlspecialchars($paticipant['nom']) ?></td>
                            <td><?php echo htmlspecialchars($paticipant['prenom']) ?></td>
                            <td><input type="submit" name="delete<?php echo $i?>" value="Supprimer"></td>
                        </tr>
                        <?php
                        if(isset($_POST['delete'.$i])){
                            $deleteplayer->execute(array('numero_licence' =>$paticipant['numero_licence'] ,'datem' => $datem , 'heurem' => $heurem));
                        }
                            $i++;
                         endwhile; ?>
                    </tbody>
                </table>
            </fieldset>



            </form>
         </section>

         
	</body>
</html>