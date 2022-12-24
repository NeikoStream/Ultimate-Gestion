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

    $requete1 = $linkpdo->prepare('SELECT DATE_FORMAT(datem, "%d/%m/%Y") datem ,
                                DATE_FORMAT(heurem,"%H:%i") heurem,
                                nom_equipe_adverse,
                                etre_domicile,
                                etre_prepare
                                FROM matchs 
                                WHERE DATE_FORMAT(datem,"%Y-%m-%d") >= DATE_FORMAT(now(),"%Y-%m-%d")
                                AND DATE_FORMAT(heurem,"%H:%i") >= DATE_FORMAT(datem,"%H:%i")
                                order by DATE_FORMAT(datem,"%Y-%m-%d"),heurem');
    ///Liens entre variables PHP et marqueurs
   $requete1->execute();

   $requete2 = $linkpdo->prepare('SELECT DATE_FORMAT(datem, "%d/%m/%Y") datem ,
                                DATE_FORMAT(heurem,"%H:%i") heurem,
                                nom_equipe_adverse,
                                etre_domicile,
                                score_equipe,
                                score_adverse
                                FROM matchs 
                                WHERE DATE_FORMAT(datem,"%Y-%m-%d") < DATE_FORMAT(now(),"%Y-%m-%d")
                                order by DATE_FORMAT(datem,"%Y-%m-%d")desc,heurem desc');

    $requete2->execute();
    
    echo "Date du jour : ", strftime("%d/%m/%Y");
?>
    <h2 class="titre_joueurs">Liste des matchs à venir</h2>
        <li class="listejoueurs">
            <a class="joueur" href="saisieMatch.php"><ul class="ajoutMatch">Ajouter un match</ul></a>
            <?php while($result = $requete1->fetch()): ?>
                <a class="joueur" href="modifierMatch.php">
                    <ul>
                        <!--<img class="photo_joueur" src=<?php echo htmlspecialchars($result['image']); ?> 
                        alt="Blason de <?php echo htmlspecialchars($result['nom_equipe_adverse']); ?>" width="100">-->
                        <h3>Le <?php echo htmlspecialchars($result['datem']); ?> à <?php echo htmlspecialchars($result['heurem'])?></h3>
                        <p class="statut_joueur"><?php if(htmlspecialchars($result['etre_domicile'])==1)echo "A domicile";else echo"</br>";?></p>
                        <p>Adversaires : <?php echo htmlspecialchars($result['nom_equipe_adverse']); ?></p>
                        <p class="prepare"><?php if(htmlspecialchars($result['etre_prepare'])==0)echo "A PREPARER";?></p>
                        <?php if(htmlspecialchars($result['etre_prepare'])==1) {?>
                            <h4>Joueurs Titulaire :</h4>
                            <?php
                                $vardate=htmlspecialchars($result['datem']);
                                $varheure=htmlspecialchars($result['heurem']);
                                $requete3 = $linkpdo->prepare('SELECT j.nom nom,j.prenom prenom
                                                            from joueur j, participer p
                                                            where j.numero_licence=p.numero_licence
                                                            and p.etre_titulaire=1
                                                            and DATE_FORMAT(p.datem, "%d/%m/%Y")=:vardate
                                                            and DATE_FORMAT(p.heurem,"%H:%i")=:varheure');

                                $requete3->execute(array(":vardate" => $vardate, ":varheure" => $varheure));
                            ?>
                            <li>
                                <?php while($result1 = $requete3->fetch()): ?>
                                    <ul>
                                        <p><?php echo htmlspecialchars($result1['prenom']); ?>
                                        <?php echo htmlspecialchars($result1['nom']); ?></p>
                                        <!--N'AFFICHE RIEN POUR LE MOMENT, mais dois afficher la liste des joueurs titulaires-->
                                    </ul>
                                <?php endwhile; ?>
                            </li>
                        <?php } ?>
                    </ul>
                </a>
            <?php endwhile; ?>
        </li>

    <h2 class="titre_joueurs">Liste des matchs passés</h2>
        <li class="listejoueurs">
            <?php while($result = $requete2->fetch()): ?>
            <a class="joueur" href="modifierMatch.php">
                <ul>
                    <!--<img class="photo_joueur" src=<?php echo htmlspecialchars($result['image']); ?> 
                    alt="Blason de <?php echo htmlspecialchars($result['nom_equipe_adverse']); ?>" width="100">-->
                    <h3>Le <?php echo htmlspecialchars($result['datem']); ?> à <?php echo htmlspecialchars($result['heurem'])?></h3>
                    <p class="statut_joueur"><?php if(htmlspecialchars($result['etre_domicile'])==1)echo "A domicile";?></p>
                    <p>Adversaires : <?php echo htmlspecialchars($result['nom_equipe_adverse']); ?></p>
                    <p>Score : <?php echo htmlspecialchars($result['score_equipe']); ?>-<?php echo htmlspecialchars($result['score_adverse']); ?></p>
                    <h4>Joueurs Titulaire :</h4>
                    <?php
                        $vardate=htmlspecialchars($result['datem']);
                        $varheure=htmlspecialchars($result['heurem']);
                        $requete3 = $linkpdo->prepare('SELECT j.nom nom,j.prenom prenom
                                                    from joueur j, participer p
                                                    where j.numero_licence=p.numero_licence
                                                    and p.etre_titulaire=1
                                                    and DATE_FORMAT(p.datem, "%d/%m/%Y")=:vardate
                                                    and DATE_FORMAT(p.heurem,"%H:%i")=:varheure');

                        $requete3->execute(array(":vardate" => $vardate, ":varheure" => $varheure));
                    ?>
                    <li>
                        <?php while($result1 = $requete3->fetch()): ?>
                            <ul>
                                <p><?php echo htmlspecialchars($result1['prenom']); ?>
                                <?php echo htmlspecialchars($result1['nom']); ?></p>
                                <!--N'AFFICHE RIEN POUR LE MOMENT, mais dois afficher la liste des joueurs titulaires-->
                            </ul>
                        <?php endwhile; ?>
                    </li>
                </ul>
            </a>
            <?php endwhile; ?>
        </li>
</body>
</html>