<?php 
require 'connexionbd.php';
$imgEquipe = $linkpdo->prepare('SELECT img from joueur where numero_licence = :numero_licence');
$imgEquipe->execute(array('numero_licence' => $numlic));
$imge = $imgEquipe->fetch();

unlink('../img/Equipe/'.$imge['img']);


//appel a la method de recuperation du parmettre dans l'url
$idEquipe = htmlspecialchars($_GET["idEquipe"]);
$req = $linkpdo->prepare('DELETE FROM adversaire WHERE id_adversaire = :id_adversaire');
$req->execute(array('id_adversaire' => $idEquipe));

header('Location: ../page/adversaires.php');
?>