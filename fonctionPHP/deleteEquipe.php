<?php 
require 'connexionbd.php';
//appel a la method de recuperation du parmettre dans l'url
$idEquipe = htmlspecialchars($_GET["idEquipe"]);
$req = $linkpdo->prepare('DELETE FROM adversaire WHERE id_adversaire = :id_adversaire');
$req->execute(array('id_adversaire' => $idEquipe));

header('Location: ../page/adversaires.php');
?>