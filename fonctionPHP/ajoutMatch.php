<?php
	require 'connexionbd.php';

    $datem = $_POST['datem_saisie'];
	$heurem = $_POST['heurem_saisie'];
	$idEquipe = $_POST['equipe'];
    if (isset($_POST['etre_domicile_saisie'])){
        $etre_domicile = 1;
    }else{
        $etre_domicile = 0;
    }
	$req = $linkpdo->prepare('INSERT INTO matchs (datem, heurem, id_adversaire, etre_domicile) VALUES (:datem, :heurem, :id_adversaire, :etre_domicile)');
	$req->execute(array('datem' => $datem,'heurem' => $heurem,'id_adversaire' => $idEquipe, 'etre_domicile' => $etre_domicile));

    header('Location: ../page/match.php');
    exit;
?>