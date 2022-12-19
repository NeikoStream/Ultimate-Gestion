<?php
	require 'connexionbd.php';

	$nom = $_POST['nom_saisie'];
	$prenom = $_POST['prenom_saisie'];
	$photo = $_POST['photo_saisie'];
	$numero_licence = $_POST['num_licence_saisie'];
	$date_naissance = $_POST['date_naissance_saisie'];
	$taille = $_POST['taille_saisie'];
	$poids = $_POST['poids_saisie'];
	$poste_prefere = $_POST['poste_saisie'];
	$note_perso = $_POST['note_saisie'];
	$statut = $_POST['statut_saisie'];
	$req = $linkpdo->prepare('INSERT INTO joueur (numero_licence,nom, prenom, photo, date_naissance, taille, poids, poste_prefere, note_perso, statut) VALUES (:numero_licence,:nom, :prenom, :photo, :date_naissance, :taille, :poids, :poste_prefere, :note_perso, :statut)');
	$req->execute(array('numero_licence' => $numero_licence,'nom' => $nom,'prenom' => $prenom, 'photo' => $photo,'date_naissance' => $date_naissance,'taille' => $taille,'poids' => $poids,'poste_prefere' => $poste_prefere,'note_perso' => $note_perso,'statut' => $statut));
?>

//recupération de l'image à travailler