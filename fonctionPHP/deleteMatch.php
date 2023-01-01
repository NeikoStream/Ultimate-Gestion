<?php 
require 'connexionbd.php';
//appel a la method de recuperation du parmettre dans l'url
$datem = htmlspecialchars($_GET["datem"]);
$heurem = htmlspecialchars($_GET["heurem"]);
$req = $linkpdo->prepare('DELETE FROM matchs WHERE datem = :datem AND heurem = :heurem');
$req->execute(array('datem' => $datem, 'heurem' => $heurem));

header('Location: ../page/match.php');
?>