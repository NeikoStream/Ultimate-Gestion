<?php
	require 'connexionbd.php';

    $datem = $_POST['datem_saisie'];
	$heurem = $_POST['heurem_saisie'];
	$nom_equipe_adverse = $_POST['nom_equipe_adverse_saisie'];
    if (isset($_POST['etre_domicile_saisie'])){
        $etre_domicile = 1;
    }else{
        $etre_domicile = 0;
    }
	$req = $linkpdo->prepare('INSERT INTO matchs (datem, heurem, nom_equipe_adverse, etre_domicile) VALUES (:datem, :heurem, :nom_equipe_adverse, :etre_domicile)');
	$req->execute(array('datem' => $datem,'heurem' => $heurem,'nom_equipe_adverse' => $nom_equipe_adverse, 'etre_domicile' => $etre_domicile));

    header('Location: ../page/match.php');
    exit;
?>