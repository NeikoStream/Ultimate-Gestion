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
            
        </div>
        <div class="score">
            <h1>Score</h1>
        </div>

        <div class="SeparationScore">
            <button>Voir en détail</button>
        </div>
        <div class="score">
            <h1>Score</h1>
        </div>

        
        <div class="Equipe2">
            <img class="LogoEquipe" src="../img/Equipe/TFC_LOGO.png" alt="">
        </div>
    </div>

    <div class="match">
        <div class="Equipe1">
            <img class="LogoEquipe" src="../img/Equipe/TFC_LOGO.png" alt="">
            
        </div>
        <div class="score">
            <h1>Score</h1>
        </div>

        <div class="SeparationScore">
            <button>Voir en détail</button>
        </div>
        <div class="score">
            <h1>Score</h1>
        </div>

        
        <div class="Equipe2">
            <img class="LogoEquipe" src="../img/Equipe/TFC_LOGO.png" alt="">
        </div>
    </div>
</div>


</body>
</html>