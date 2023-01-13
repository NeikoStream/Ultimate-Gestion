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
$joueurs = $linkpdo->prepare('SELECT DISTINCT * from joueur where joueur.numero_licence not in (SELECT joueur.numero_licence from joueur,participer WHERE participer.datem = :datem AND participer.heurem = :heurem AND participer.numero_licence = joueur.numero_licence);');
$joueurs->execute(array('datem' => $datem , 'heurem' => $heurem));

//recuperer les participant d'un match
$paticipants = $linkpdo->prepare('SELECT participer.datem,participer.heurem ,joueur.numero_licence,joueur.nom,joueur.prenom, participer.etre_titulaire, participer.poste from joueur,participer where participer.datem = :datem AND participer.heurem = :heurem AND joueur.numero_licence = participer.numero_licence;');
$paticipants->execute(array('datem' => $datem , 'heurem' => $heurem));

//preparation de la requete d'ajout d'un joueur a un match
$addplayer = $linkpdo->prepare('INSERT INTO participer (numero_licence,datem, heurem) VALUES (:numero_licence, :datem, :heurem)');

//preparation de la requete de suppression d'un joueur a un match
$deleteplayer = $linkpdo->prepare('DELETE from participer where numero_licence = :numero_licence AND datem = :datem AND heurem = :heurem');

//preparation de la requete d'edition d'un joueur a un match
$editplayer = $linkpdo->prepare('UPDATE participer SET etre_titulaire = :etre_titulaire ,poste = :poste where numero_licence = :numero_licence AND datem = :datem AND heurem = :heurem');

//recup nbparticipant
$nbpaticipants = $linkpdo->prepare('SELECT count(*) as nb from joueur,participer where participer.etre_titulaire = 1 AND  participer.datem = :datem AND participer.heurem = :heurem AND joueur.numero_licence = participer.numero_licence;');
$nbpaticipants->execute(array('datem' => $datem , 'heurem' => $heurem));
$totalpaticipants = $nbpaticipants->fetch();

//variable max joueur
$maxplayer =7;

//Etat match edit
$editetat = $linkpdo->prepare('UPDATE matchs SET etre_prepare = :etre_prepare where datem = :datem AND heurem = :heurem');

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
                            <th>Photo</th>
                            <th>NumLicence</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Taille</th>
                            <th>Poids</th>
                            <th>Poste préféré</th>
                            <th>Commentaire</th>
                            <th><input type="submit" class="button1" name="Actualiser" value="Actualiser"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $nbjoueursnonparticipant = 0; 
                            while ($joueur = $joueurs->fetch()):
                            ?>
                        <tr>
                            <td><img src="../img/<?php echo htmlspecialchars($joueur['photo']) ?>" alt="" height=50 width=50></td>
                            <td><?php echo htmlspecialchars($joueur['numero_licence']) ?></td>
                            <td><?php echo htmlspecialchars($joueur['nom']) ?></td>
                            <td><?php echo htmlspecialchars($joueur['prenom']) ?></td>
                            <td><?php echo htmlspecialchars($joueur['taille']) ?> cm</td>
                            <td><?php echo htmlspecialchars($joueur['poids']) ?> kg</td>
                            <td><?php echo htmlspecialchars($joueur['poste_prefere']) ?></td>
                            <td><?php echo htmlspecialchars($joueur['note_perso']) ?></td>
                            <td><input type="submit" name="add<?php echo $nbjoueursnonparticipant?>" value="Ajouter">
                                

                            </td>
                        </tr>
                        <?php

                        if(isset($_POST['add'.$nbjoueursnonparticipant])){
                            $addplayer->execute(array('numero_licence' =>$joueur['numero_licence'] ,'datem' => $datem , 'heurem' => $heurem));
                            
                        }
                        $nbjoueursnonparticipant++;
                         endwhile; ?>
                    </tbody>
                </table>
            </fieldset>
            <?php
            if($totalpaticipants['nb'] == $maxplayer){
                echo "<h1>Match pret</h1>";
            } else {
                echo "<h1>Match à préparer</h1>";
            } ?>
            
            <fieldset>
                <legend>Titulaires : <?php echo $totalpaticipants['nb']." / ". $maxplayer?></legend>
                <table>
                    <thead>
                        <tr>
                            <th>NumLicence</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Rôle</th>
                            <th>Titulaire</th>
                            <th><input type="submit" class="button1" name="Actualiser" value="Actualiser"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $joueurparticipant = 0;
                        while ($paticipant = $paticipants->fetch()):
                            $idJoueurs[$joueurparticipant] = $paticipant['numero_licence'];?>
                        <tr>
                            
                            <td><?php echo htmlspecialchars($paticipant['numero_licence']) ?></td>
                            <td><?php echo htmlspecialchars($paticipant['nom']) ?></td>
                            <td><?php echo htmlspecialchars($paticipant['prenom']) ?></td>
                            
                            <td><select name="poste<?php echo $joueurparticipant?>" id="poste_saisie">
                                    <option value="<?php echo htmlspecialchars($paticipant['poste']) ?>">[ <?php echo htmlspecialchars($paticipant['poste']) ?> ]</option>
                                    <option value="Attaquant">Attaquant</option>
                                    <option value="Défenseur">Défenseur</option>
                                    <option value="Aucun">Aucun</option>
                                </select></td>
                            <td><input type="checkbox" name="etretitulaire<?php echo $joueurparticipant?>" id="etretitulaire" <?php if ($paticipant['etre_titulaire']) {
                            echo "checked"; } ?>/></td>
                            <td><input type="submit" name="delete<?php echo $joueurparticipant?>" value="Supprimer"></td>
                        </tr>
                        <?php
                        if(isset($_POST['delete'.$joueurparticipant])){
                            $deleteplayer->execute(array('numero_licence' =>$paticipant['numero_licence'] ,'datem' => $datem , 'heurem' => $heurem));
                        }
                        $joueurparticipant++;
                         endwhile; ?>
                    </tbody>
                </table>
                 
            </fieldset>
                <div>
                    <a href="<?php echo "modifierMatch.php?datem=".$datem."&heurem=".$heurem?>">Retour</a>
                    <button type="submit" name="Valider" value="Valider">Valider</button>   
                </div>
            
            <?php
                        if(isset($_POST['Valider'])){
                            $a=0;
                            while ($a<$joueurparticipant):
                                    if (isset($_POST['etretitulaire'.$a])){
                                        $etretitulaire = 1;
                                    }else{
                                        $etretitulaire = 0;
                                    }

                                    if (isset($_POST['poste'.$a])){
                                        $poste = $_POST['poste'.$a];
                                    }else{
                                        $poste = NULL;
                                    }

                                    
                                    $editplayer->execute(array('poste' => $poste,'etre_titulaire'=> $etretitulaire,'numero_licence' =>$idJoueurs[$a] ,'datem' => $datem , 'heurem' => $heurem));
                                $a++;
                            endwhile;
                            
                            //Définit l'état du match si nbtitulaire suffisant
                            if ($totalpaticipants['nb'] == $maxplayer){
                                $etat = 1;
                            }else{
                                $etat = 0;
                            }
                            $editetat ->execute(array('etre_prepare'=> $etat,'datem' => $datem , 'heurem' => $heurem));
                            
                        }
                            
                        ?>        

            </form>
         </section>


         
<?php require 'footer.php'; ?>
