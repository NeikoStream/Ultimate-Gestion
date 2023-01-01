<?php
	require 'connexionbd.php';

	$nom = $_POST['nom_equipe_adverse_saisie'];

	$req = $linkpdo->prepare('INSERT INTO adversaire (nom_equipe_adverse) VALUES (:nom)');
	//ajout de l'equipe sans l'image
	$req->execute(array('nom' => $nom));

    $recupid = $linkpdo->prepare('SELECT * FROM adversaire WHERE nom_equipe_adverse = :nom');
    $recupid->execute(array('nom' => $nom));
    $idequipe = $recupid->fetch();

	//partie ajout d'une photo
	if(isset($_FILES['photo_saisie']) AND !empty($_FILES['photo_saisie']['name'])){
		//correspond a 2Mio
		$tailleMax = 2097152;
		$extensionsValides = array('jpg', 'jpeg', 'png');
		if($_FILES['photo_saisie']['size'] <= $tailleMax){
			$extensionUpload = strtolower(substr(strrchr($_FILES['photo_saisie']['name'], '.'), 1));
			if(in_array($extensionUpload,$extensionsValides)){
				$chemin = "../img/".$idequipe['id_adversaire'].".".$extensionUpload;
				$resultat = move_uploaded_file($_FILES['photo_saisie']['tmp_name'],$chemin);
				if($resultat){
					$photo = $idequipe['id_adversaire'].".".$extensionUpload;
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
	}

    $addimg = $linkpdo->prepare('UPDATE adversaire SET img = :photo WHERE id_adversaire = :id_adversaire');
    $addimg->execute(array('photo' => $photo, 'id_adversaire' => $idequipe['id_adversaire']));

	header('Location: ../page/adversaires.php');
    exit;

?>