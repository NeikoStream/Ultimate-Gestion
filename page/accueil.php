<?php 

//Partie empechant l'utilisateur non connecter a accéder au contenue (mettre en commentaire pour modifier le code facilement)
require '../fonctionPHP/authentification.php';
forcer_utilisateur_connecte();
//Appel du header
$title = "Accueil";
require 'header.php'; ?>

<h1 id="Titre-accueil">Match de la saison</h1>
<div class="Container-match">
    <div class="match">
        <div class="Equipe1">
            <img class="LogoEquipe" src="../img/Equipe/TFC_LOGO.png" alt="">
            <h1>5</h1>
        <div class="Equipe2">
            <img class="LogoEquipe" src="../img/Equipe/TFC_LOGO.png" alt="">
            <h1>5</h1>
        </div>
        
    </div>
</div>


</body>
</html>