<?php
	require 'connexionbd.php';
    $idequipe = htmlspecialchars($_GET["idEquipe"]);
	
    $nom = $_POST['nom_equipe_adverse_saisie'];

	$req = $linkpdo->prepare('UPDATE adversaire SET nom = :nom ,  img = :photo WHERE id_adversaire = :id_adversaire');
	

    $recupimg = $linkpdo->prepare('SELECT img FROM adversaire WHERE id_adversaire = :id_adversaire');
    $recupimg->execute(array('id_adversaire' => $idequipe));
    $img = $recupimg->fetch();


	//partie ajout d'une photo
	if(isset($_FILES['photo_saisie']) AND !empty($_FILES['photo_saisie']['name'])){
		//correspond a 2Mio
		$tailleMax = 2097152;
		$extensionsValides = array('jpg', 'jpeg', 'png');
		if($_FILES['photo_saisie']['size'] <= $tailleMax){
			$extensionUpload = strtolower(substr(strrchr($_FILES['photo_saisie']['name'], '.'), 1));
			if(in_array($extensionUpload,$extensionsValides)){
				$chemin = "../img/".$nom.".".$extensionUpload;
				$resultat = move_uploaded_file($_FILES['photo_saisie']['tmp_name'],$chemin);
				if($resultat){
					$photo = $nom.".".$extensionUpload;;
				}
				else{
					$msg = "erreur durant l'importation de la photo";
				}
			}
			else{
				$msg = "La photo doit etre au format jpg, jpeg, png ";
			}
		}
		else{
			$msg = "La photo ne doit pas dépasser 2MO ";
		}
	}else {
        $photo = $img['img'];
    }

    echo $nom." ".$photo." ".$idequipe;

	$req->execute(array('nom' => $nom, 'photo' => $photo, 'id_adversaire' => $idequipe));
	

	header('Location: ../page/adversaires.php');
    exit;

?>