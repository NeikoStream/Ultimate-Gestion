<?php
require 'connexionbd.php';
$passhash = password_hash('$iutinfo', PASSWORD_DEFAULT, ['cost'=>12]);

$req = $linkpdo->prepare('UPDATE utilisateur SET mot_de_passe = :pass WHERE nom_utilisateur = :nvuser');
$req -> execute(array('nvuser' => 'admin' , 'pass' => $passhash));

