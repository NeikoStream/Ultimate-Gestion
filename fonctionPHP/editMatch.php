<?php
	require 'connexionbd.php';
    $datemAvant = htmlspecialchars($_GET["datem"]);
    $heuremAvant = htmlspecialchars($_GET["heurem"]);
    $datem = $_POST['datem_saisie'];
	$heurem = $_POST['heurem_saisie'];
	$idEquipe = $_POST['equipe'];
    if (isset($_POST['etre_domicile_saisie'])){
        $etre_domicile = 1;
    }else{
        $etre_domicile = 0;
    }

    if ($_POST['scoremaison'] == NULL) {
        $scoreEquipe = NULL;
    }else{
        $scoreEquipe = $_POST['scoremaison'];
      }
    if ($_POST['scoreadverse'] == NULL) {
        $scoreAdverse = NULL;
    }else{
        $scoreAdverse = $_POST['scoremaison'];
      }

	$req = $linkpdo->prepare('UPDATE matchs SET datem= :datem,heurem= :heurem,id_adversaire=:id_adversaire,etre_domicile= :etre_domicile, score_equipe = :score_equipe, score_adverse = :score_adverse WHERE datem= :dateAvant AND heurem = :heureAvant');
	$req->execute(array('datem' => $datem,
                        'heurem' => $heurem,
                        'id_adversaire' => $idEquipe, 
                        'etre_domicile' => $etre_domicile, 
                        'dateAvant' => $datemAvant, 
                        'heureAvant' => $heuremAvant,
                        'score_equipe' => $scoreEquipe,
                        'score_adverse' => $scoreAdverse));

    header('Location: ../page/match.php');
    exit;
?>