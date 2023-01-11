<?php 
require 'connexionbd.php';
//appel a la method de recuperation du parmettre dans l'url
$numlic = htmlspecialchars($_GET["lic"]);
$imgJoueur = $linkpdo->prepare('SELECT photo from joueur where numero_licence = :numero_licence');
$imgJoueur->execute(array('numero_licence' => $numlic));
$imgj = $imgJoueur->fetch();

unlink('../img/'.$imgj['photo']);
$req = $linkpdo->prepare('DELETE FROM joueur WHERE numero_licence = :numero_licence');
$req->execute(array('numero_licence' => $numlic));

header('Location: ../page/joueurs.php');
?>