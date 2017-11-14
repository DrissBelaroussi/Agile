<?php
 require_once('SPDO.php');
 require_once('debut.php');
 require_once('modification.php');
 require_once('fonctions.php');


$bd = spdo::getDB ();


if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['datenaissance']) && isset($_POST['adresse']) && isset($_POST['ville']) && isset($_POST['tel']) && isset($_POST['mail']) && isset($_POST['cp']))

	{
		$login = $_SESSION['login'];
		$nomPatient = $_POST['nom'];
		$prenomPatient = $_POST['prenom'];
		$dateNaissance = $_POST['datenaissance'];
		$adresse = $_POST['adresse'];
		$ville = $_POST['ville'];
		$cp = $_POST['cp'];
		$tel = $_POST['tel'];
		$mail = $_POST['mail'];


		updateUser($login, $nomPatient, $prenomPatient, $adresse, $dateNaissance, $ville, $tel, $mail, $cp);




		if(isset($_POST['nouvmdp']) && isset($_POST['nouvmdp2']) && $_POST['nouvmdp'] != '' ){
			$nouvmdp = $_POST['nouvmdp'];
			$nouvmdp2 = $_POST['nouvmdp2'];

			if($nouvmdp === $nouvmdp2 ){
				updatePassword($nouvmdp, $_POST['mdp']);

			}

		}

	}
else{

	var_dump($_POST);
}



?>
