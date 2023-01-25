<?php 

//Partie empechant l'utilisateur non connecter a accéder au contenue (mettre en commentaire pour modifier le code facilement)
require '../fonctionPHP/authentification.php';
forcer_utilisateur_connecte();
//Appel du header
$title = "Matchs";
require 'header.php'; 

// METHODE avec PDO
// récupérer tous les matchs

require '../fonctionPHP/connexionbd.php';


    ///Préparation de la requête sans les variables (marqueurs : nominatifs)
    ///DATE_FORMAT(datem, "%W %e %M %Y") (problème : en anglais)

    $requete1 = $linkpdo->prepare('SELECT datem datem2,DATE_FORMAT(datem, "%d/%m/%Y") datem ,
                                DATE_FORMAT(heurem,"%H:%i") heurem,
                                nom_equipe_adverse,
                                etre_domicile,
                                etre_prepare
                                FROM matchs, adversaire 
                                WHERE matchs.id_adversaire = adversaire.id_adversaire AND
                                DATE_FORMAT(datem,"%Y-%m-%d") >= DATE_FORMAT(now(),"%Y-%m-%d")
                                AND DATE_FORMAT(heurem,"%H:%i") >= DATE_FORMAT(datem,"%H:%i")
                                order by DATE_FORMAT(datem,"%Y-%m-%d"),heurem');
    ///Liens entre variables PHP et marqueurs
   $requete1->execute();

   $requete2 = $linkpdo->prepare('SELECT datem datem2,DATE_FORMAT(datem, "%d/%m/%Y") datem ,
   DATE_FORMAT(heurem,"%H:%i") heurem,
   nom_equipe_adverse,
   etre_domicile,
   score_equipe,
   score_adverse
   FROM matchs, adversaire
   WHERE matchs.id_adversaire = adversaire.id_adversaire 
   AND DATE_FORMAT(datem,"%Y-%m-%d") < DATE_FORMAT(now(),"%Y-%m-%d")
   AND matchs.score_equipe IS NOT NULL
   AND matchs.score_adverse IS NOT NULL
   AND matchs.etre_prepare = 1
   order by DATE_FORMAT(datem,"%Y-%m-%d")desc,heurem desc;');

    $requete2->execute();
    
    //Liste des titulaire

    $requete3 = $linkpdo->prepare('SELECT j.nom nom,j.prenom prenom
                                                    from joueur j, participer p
                                                    where j.numero_licence=p.numero_licence
                                                    and p.etre_titulaire=1
                                                    and DATE_FORMAT(p.datem, "%d/%m/%Y")=:vardate
                                                    and DATE_FORMAT(p.heurem,"%H:%i")=:varheure');

    //Match dont le score ou la feuille de match n'est pas saisie

    $requete4 = $linkpdo->prepare('SELECT datem datem2,DATE_FORMAT(datem, "%d/%m/%Y") datem , DATE_FORMAT(heurem,"%H:%i") heurem, nom_equipe_adverse, etre_domicile, score_equipe, score_adverse, etre_prepare 
                                    FROM matchs, adversaire 
                                    WHERE matchs.id_adversaire = adversaire.id_adversaire 
                                    AND DATE_FORMAT(datem,"%Y-%m-%d") < DATE_FORMAT(now(),"%Y-%m-%d") 
                                    AND (matchs.etre_prepare = 0
                                    OR matchs.score_equipe IS NULL 
                                    OR matchs.score_adverse IS NULL)
                                    order by DATE_FORMAT(datem,"%Y-%m-%d")desc,heurem desc;');

    $requete4->execute();

    /*echo "Date du jour : ", strftime("%d/%m/%Y");*/
?>
    <h2 class="titre_joueurs">Liste des matchs à venir</h2>
        <ul class="listejoueurs">
            <a class="joueur" href="saisieMatch.php"><ul class="ajoutMatch">Ajouter un match</ul></a>
            <?php while($result = $requete1->fetch()): ?>
                <a class="joueur" href="<?php echo "modifierMatch.php?datem=".$result['datem2']."&heurem=".$result['heurem']?>">
                    <li>
                        <!--<img class="photo_joueur" src=<?php echo htmlspecialchars($result['image']); ?> 
                        alt="Blason de <?php echo htmlspecialchars($result['nom_equipe_adverse']); ?>" width="100">-->
                        <h3>Le <?php echo htmlspecialchars($result['datem']); ?> à <?php echo htmlspecialchars($result['heurem'])?></h3>
                        <p class="statut_joueur"><?php if(htmlspecialchars($result['etre_domicile'])==1)echo "A domicile";else echo"</br>";?></p>
                        <p class="nomadversaire">Adversaires : <?php echo htmlspecialchars($result['nom_equipe_adverse']); ?></p>
                        <?php if(htmlspecialchars($result['etre_prepare'])==1) {?>
                            <h4>Joueurs Titulaire :</h4>
                            <?php
                                $vardate=htmlspecialchars($result['datem']);
                                $varheure=htmlspecialchars($result['heurem']);
                                $requete3->execute(array(":vardate" => $vardate, ":varheure" => $varheure));
                            ?>
                            <ul>
                                <?php while($result1 = $requete3->fetch()): ?>
                                    <li>
                                        <p><?php echo htmlspecialchars($result1['prenom']); ?>
                                        <?php echo htmlspecialchars($result1['nom']); ?></p>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php }else{ ?>
                            </br>
                            <p class="prepare">A PREPARER</p>
                        <?php }?>
                    </li>
                </a>
            <?php endwhile; ?>
        </ul>
    
    <h2 class="titre_joueurs">Saisir le score des matchs / feuille de match</h2>
    <ul class="listejoueurs"> 
        <?php while($result = $requete4->fetch()): ?>
            <a class="joueur" href="<?php echo "modifierMatch.php?datem=".$result['datem2']."&heurem=".$result['heurem']?>">
                    <li>
                        <!--<img class="photo_joueur" src=<?php echo htmlspecialchars($result['image']); ?> 
                        alt="Blason de <?php echo htmlspecialchars($result['nom_equipe_adverse']); ?>" width="100">-->
                        <h3>Le <?php echo htmlspecialchars($result['datem']); ?> à <?php echo htmlspecialchars($result['heurem'])?></h3>
                        <p class="statut_joueur"><?php if(htmlspecialchars($result['etre_domicile'])==1)echo "A domicile";else echo"</br>";?></p>
                        <p class="nomadversaire">Adversaires : <?php echo htmlspecialchars($result['nom_equipe_adverse']); ?></p>
                        <?php if(htmlspecialchars($result['etre_prepare'])==1) {?>
                            <h4>Joueurs Titulaire :</h4>
                            <?php
                                $vardate=htmlspecialchars($result['datem']);
                                $varheure=htmlspecialchars($result['heurem']);
                                $requete3->execute(array(":vardate" => $vardate, ":varheure" => $varheure));
                            ?>
                            <ul>
                                <?php while($result1 = $requete3->fetch()): ?>
                                    <li>
                                        <p><?php echo htmlspecialchars($result1['prenom']); ?>
                                        <?php echo htmlspecialchars($result1['nom']); ?></p>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php }else{ ?>
                            </br>
                            <p class="prepare">SAISIR FEUILLE MATCH</p>
                        <?php }?>

                        <?php if(htmlspecialchars($result['score_equipe'])== NULL && htmlspecialchars($result['score_adverse'])== NULL) {?>
                            <p class="prepare">SAISIR SCORE</p>
                        <?php }?>
                    </li>
                </a>
        <?php endwhile; ?>
    </ul>     

    <h2 class="titre_joueurs">Liste des matchs passés</h2>
        <ul class="listejoueurs">
            <?php while($result = $requete2->fetch()): ?>
            <a class="joueur" href="<?php echo "modifierMatch.php?datem=".$result['datem2']."&heurem=".$result['heurem']?>">
                <li>
                    <!--<img class="photo_joueur" src=<?php echo htmlspecialchars($result['image']); ?> 
                    alt="Blason de <?php echo htmlspecialchars($result['nom_equipe_adverse']); ?>" width="100">-->
                    <h3>Le <?php echo htmlspecialchars($result['datem']); ?> à <?php echo htmlspecialchars($result['heurem'])?></h3>
                    <p class="statut_joueur"><?php if(htmlspecialchars($result['etre_domicile'])==1)echo "A domicile";?></p>
                    <p class="nomadversaire">Adversaires : <?php echo htmlspecialchars($result['nom_equipe_adverse']); ?></p>
                    <p>Score : <?php echo htmlspecialchars($result['score_equipe']); ?>-<?php echo htmlspecialchars($result['score_adverse']); ?></p>
                    <h4 class="nomadversaire">Joueurs Titulaire :</h4>
                    <?php
                        $vardate=htmlspecialchars($result['datem']);
                        $varheure=htmlspecialchars($result['heurem']);
                        $requete3->execute(array(":vardate" => $vardate, ":varheure" => $varheure));
                    ?>
                    <ul>
                        <?php while($result1 = $requete3->fetch()): ?>
                            <li>
                                <p><?php echo htmlspecialchars($result1['prenom']); ?>
                                <?php echo htmlspecialchars($result1['nom']); ?></p>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                </li>
            </a>
            <?php endwhile; ?>
        </ul>

<?php require 'footer.php'; ?>