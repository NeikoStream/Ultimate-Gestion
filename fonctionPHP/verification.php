<?php
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {

    // connexion à la base de données AVEC PDO
    require 'connexionbd.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    //AVEC PDO
    if ($username !== "" && $password !== "") {
        ///Préparation de la requête sans les variables (marqueurs : nominatifs)

        $requete = $linkpdo->prepare('SELECT mot_de_passe FROM utilisateur where nom_utilisateur = :user');

        ///Liens entre variables PHP et marqueurs
        $requete->execute([
            'user' => $username
        ]);

        $mdphash = $requete->fetch();

        if (password_verify($password, $mdphash[0])) // nom d'utilisateur et mot de passe correctes
        {
            $_SESSION['connecte'] = $username;
            header('Location: ../page/accueil.php');
        } else {
            header('Location: ../index.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    } 
} else {
    header('Location: ../index.php');
}

?>