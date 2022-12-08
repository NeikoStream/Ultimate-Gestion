<?php 

//fonction de verification si l'utilisateur est connecter
function est_connecte(): bool {
    if (session_status() === PHP_SESSION_NONE){
        session_start();
    }
    return !empty($_SESSION['connecte']);
}

//fonction qui empeche l'utilisateur de voir la page
function forcer_utilisateur_connecte(): void {
    if(!est_connecte()){
        header('Location: login.php'); // Renvoie vers -> login.php
        exit(); //permet d'arreter le script ici (il ne verra pas la suite du code)
    }
}