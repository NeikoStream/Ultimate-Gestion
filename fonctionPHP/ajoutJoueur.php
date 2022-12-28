<?php
	require 'connexionbd.php';

	$nom = $_POST['nom_saisie'];
	$prenom = $_POST['prenom_saisie'];
	$numero_licence = $_POST['num_licence_saisie'];
	$date_naissance = $_POST['date_naissance_saisie'];
	$taille = $_POST['taille_saisie'];
	$poids = $_POST['poids_saisie'];
	$poste_prefere = $_POST['poste_saisie'];
	$note_perso = $_POST['note_saisie'];
	$statut = $_POST['statut_saisie'];
	$req = $linkpdo->prepare('INSERT INTO joueur (numero_licence,nom, prenom, photo, date_naissance, taille, poids, poste_prefere, note_perso, statut) VALUES (:numero_licence,:nom, :prenom, :photo, :date_naissance, :taille, :poids, :poste_prefere, :note_perso, :statut)');
	
	//partie ajout d'une photo
	if(isset($_FILES['photo_saisie']) AND !empty($_FILES['photo_saisie']['name'])){
		//correspond a 2Mio
		$tailleMax = 2097152;
		$extensionsValides = array('jpg', 'jpeg', 'png');
		if($_FILES['photo_saisie']['size'] <= $tailleMax){
			$extensionUpload = strtolower(substr(strrchr($_FILES['photo_saisie']['name'], '.'), 1));
			if(in_array($extensionUpload,$extensionsValides)){
				$chemin = "../img/".$numero_licence.".".$extensionUpload;
				$resultat = move_uploaded_file($_FILES['photo_saisie']['tmp_name'],$chemin);
				if($resultat){
					$photo = $numero_licence.".".$extensionUpload;;
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

	$req->execute(array('numero_licence' => $numero_licence,'nom' => $nom,'prenom' => $prenom, 'photo' => $photo,'date_naissance' => $date_naissance,'taille' => $taille,'poids' => $poids,'poste_prefere' => $poste_prefere,'note_perso' => $note_perso,'statut' => $statut));
	

	header('Location: ../page/joueurs.php');
    exit;

?>