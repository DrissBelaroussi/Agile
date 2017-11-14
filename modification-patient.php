<?php
 require_once('SPDO.php');


$bd = spdo::getDB ();


if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['datenaissance']) && isset($_POST['adresse']) && isset($_POST['ville']) && isset($_POST['tel']) && isset($_POST['mail']) && isset($_POST['cp']))

	{
		$nomPatient = $_POST['nom'];
		$prenomPatient = $_POST['prenom'];
		$dateNaissance = $_POST['datenaissance'];
		$adresse = $_POST['adresse'];
		$ville = $_POST['ville'];
		$cp = $_POST['cp'];


		/*$txt ="UPDATE Patient SET nomPatient = :nomPatient, prenomPatient= :prenomPatient, dateNaissance= :dateNaissance, adresse= :adresse, ville= :ville, cp= :cp,  tel= :tel WHERE login = :login";


		$req = $bd->prepare($txt);

		$req->bindValue(':nomPatient', $nomPatient);
		$req->bindValue(':prenomPatient', $prenomPatient);
		$req->bindValue(':dateNaissance', $dateNaissance);
		$req->bindValue(':adresse', $adresse);
		$req->bindValue(':ville', $ville);
		$req->bindValue(':cp', $cp);
		$req->bindValue(':login', $login);
		$req->execute();*/


		updateUser($login, $nomPatient, $prenomPatient, $adresse, $dateNaissance, $ville, $tel, $mail, $cp);




		if(isset($_POST['nouvmdp']) && isset($_POST['nouvmdp2'])){
			$nouvmdp = $_POST['nouvmdp'];
			$nouvmdp2 = $_POST['nouvmdp2'];

			if($nouvmdp === $nouvmdp2){
				updatePassword($nouvmdp, $nouvmdp2);

			}

		}

	}
else{

	var_dump($_POST);
}



?>
