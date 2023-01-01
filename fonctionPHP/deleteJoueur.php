<?php 
require 'connexionbd.php';
//appel a la method de recuperation du parmettre dans l'url
$numlic = htmlspecialchars($_GET["lic"]);
$req = $linkpdo->prepare('DELETE FROM joueur WHERE numero_licence = :numero_licence');
$req->execute(array('numero_licence' => $numlic));

header('Location: ../page/joueurs.php');
?>