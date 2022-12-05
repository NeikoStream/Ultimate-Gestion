<?php
	 ///Connexion au serveur MySQL
	try {
	$linkpdo = new PDO("mysql:host=127.0.0.1;dbname=ultimate", "root","");
	}
	catch (Exception $e) {
	die('Erreur : ' . $e->getMessage());
	}

	$nom = $_POST['nom_saisi'];
	$prenom = $_POST['prenom_saisi'];
	$photo = $_POST['adresse_saisi'];
	$numero_licence = $_POST['codePostal_saisi'];
	$date_naissance = $_POST['ville_saisi'];
	$taille = $_POST['telephone_saisi'];
	$poids = $_POST['telephone_saisi'];
	$poste_prefere = $_POST['telephone_saisi'];
	$note_perso = $_POST['telephone_saisi'];
	$statut = $_POST['telephone_saisi'];
	$req = $linkpdo->prepare('INSERT INTO joueur (nom, prenom, photo, numero_licence, taille, poids, poste_prefere, note_perso, statut) VALUES (:nom, :prenom, :photo, :numero_licence, :taille, :poids, :poste_prefere, :note_perso, :statut)');
	$req->execute(array('nom' => $nom, 'prenom' => $prenom, 'adresse' => $adresse, 'codePostal' => $codePostal, 'ville' => $ville, 'telephone' => $telephone));
?>