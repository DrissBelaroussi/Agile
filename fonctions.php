<?php
require_once 'SPDO.php' ;



    function connexion(){
    $msg = '' ; 

	if (isset($_POST['login']) && isset($_POST['mdp']) && trim($_POST['login']) != '' && trim($_POST['mdp']) != '')
	{
		try
		{
			$bd = spdo::getDB ();
					$medecin = false ;
					$patient = false ; 

					$txt = 'SELECT nomMedecin, prenomMedecin FROM Medecin WHERE login = :login and mdp =:mdp' ;
					$req = $bd->prepare($txt);
					$req->bindValue(':login', $_POST['login']);
					$req->bindValue(':mdp', $_POST['mdp']);
					$req->execute();
					$res1 = $req->fetch(PDO::FETCH_ASSOC);
					

					$txt = 'SELECT nomPatient, prenomPatient FROM Patient WHERE login = :login and mdp =:mdp';
					$req = $bd->prepare($txt);
					$req->bindValue(':login', $_POST['login']);
					$req->bindValue(':mdp', $_POST['mdp']);
					$req->execute();
					$res2 = $req->fetch(PDO::FETCH_ASSOC);

		

					if($res1){
						$medecin = true ;
					
						$_SESSION['nom'] = $res1['nomMedecin'];
						$_SESSION['prenom'] = $res1['prenomMedecin'];
						$_SESSION['categorie'] = 'medecin' ;
						$_SESSION['login'] =  $_POST['login'];
						$_SESSION['connecte'] = true;

						$msg = "Connexion Medecin réussie - Bienvenue ". $_SESSION['prenom'] ;			
						var_dump($_SESSION);
					} elseif($res2){
						$patient = true ; 
						$_SESSION['nom'] = $res2['nomPatient'];
						$_SESSION['prenom'] = $res2['prenomPatient'];
						$_SESSION['categorie'] = 'patient' ;
						$_SESSION['login'] = $_POST['login'] ;
						$_SESSION['connecte'] = true;	
						$msg = "Connexion Patient réussie - Bienvenue ". $_SESSION['prenom'] ;			
						var_dump($_SESSION);
					} else {
						$msg ="Connexion échouée - identifiants incorrects." ;
					}
						
		}
		
		catch (PDOException $e)
		{
			die('<p> La connexion a échoué. Erreur[' . $e->getCode() . '] : ' . $e->getMessage() . '</p>');
		}
	}
	return $msg ; 
}
	
	function deconnexion($login){
		return false ; 
	}
	
		function inscriptionPatient() {
		
		$bd = spdo::getDB ();
		if(isset($_POST['nom']), isset($_POST['prenom']), isset($_POST['datenaissance']) && isset($_POST['adresse']) && isset($_POST['ville']) && isset($_POST['tel']) && isset($_POST['mail']) && isset($_POST['cp'])){
			
			$nom = $_POST['nom'];
			$prenom = $_POST['prenom'];
			$dateNaissance = $_POST['datenaissance'];
			$adresse = $_POST['adresse'];
			$ville = $_POST['ville'];
			$cp = $_POST['cp'];
			$tel = $_POST['tel'];
			$mail = $_POST['mail'];
			$login = substr(strtolower($prenom), 0, 1).strtolower($nom);
			$mdp = "azerty";
		
			$req = "INSERT INTO Patient (nomPatient, prenomPatient, dateNaissance, adresse, ville, cp, tel, mail, login, mdp) VALUES (:nom, :prenom, :datenaissance, :adresse, :ville, :cp, :login, :mdp);";
			$stmt = $bd->prepare($req);
			$stmt->bindValue(':nom', $nom);
			$stmt->bindValue(':prenom', $prenom);
			$stmt->bindValue(':datenaissance', $dateNaissance);
			$stmt->bindValue(':adresse', $adresse);
			$stmt->bindValue(':ville', $ville);
			$stmt->bindValue(':cp', $cp);
			$stmt->bindValue(':tel', $tel);
			$stmt->bindValue('mail', $mail);
			$stmt->bindValue(':login', $login);
			$stmt->bindValue(':mdp', $mdp);
			$res = $stmt->execute();
			
			if($res){
				return true;
			} else {
				return false;
			}
		
		}
	}
	
	function redigerCompteRendu($idPatient, $idMedecin, $contenuCR){
		$stmt = SPDO::getDB() ;
		$req =  "insert into CompteRendu ( idPatient , idMedecin, contenuCompteRendu ) values (:idPatient , :idMedecin , :contenuCR) ; " ;
		$stmt->prepare($req);
				$stmt->bindValue(':idPatient', $idPatient);
				$stmt->bindValue(':idMedecin', $idMedecin);
				$stmt->bindValue(':contenuCR', $contenuCR);
				$stmt->execute();																					   
		return false ; 
	}
	
	function getCompteRendu($idPatient, $idMedecin, $date){
		$stmt = SPDO::getDB() ;
		$req = " select * from CompteRendu where idPatient = :idPatient and idMedecin = :idMedecin and date = :date ; " ;
		$stmt->prepare($req);
				$stmt->bindValue(':idPatient', $idPatient);
				$stmt->bindValue(':idMedecin', $idMedecin);
				$stmt->bindValue(':date', $date);
				$stmt->execute();
	}
	
	function supprimerCompteRendu($idCR){
		$stmt = SPDO::getDB() ;
		$req = "delete from CompteRendu where idCompteRendu = :idCR ; " ;
		$stmt->prepare($req);
				$stmt->bindValue(':idCR', $idCR);
				$stmt->execute();
		return false ;		
	}
	
	function getRDV($idPatient, $idMedecin, $date ){
		$stmt = SPDO::getDB() ;
		$req = "select * from RDV where idPatient = :idPatient and idMedecin = :idMedecin and date = :date" ;		
		$stmt->bindValue(':idPatient', $idPatient);
				$stmt->bindValue(':idMedecin', $idMedecin);
				$stmt->bindValue(':date', $date);
				$stmt->execute();
		return false ;
	}
	
	function accepterRDV( $idRDV ){
		$stmt = SPDO::getDB() ;
		$req = " update RDV set etat = 'A' where idRDV = :idRDV ;" ; 
		$stmt->bindValue(':idRDV', $idRDV);
				$stmt->execute();
		return false;
	}
	
	function refuserRDV( $idRDV ){
		$stmt = SPDO::getDB() ;
		$req = " update RDV set etat = 'R' where idRDV = :idRDV ;" ; 
		$stmt->bindValue(':idRDV', $idRDV);
				$stmt->execute();
		return false ; 
	}


	function updateUser($login, $nomPatient, $prenomPatient, $adresse, $dateNaissance, $ville, $tel, $mail, $cp){
		$bd = spdo::getDB ();
		$txt ="UPDATE Patient SET nomPatient = :nomPatient, prenomPatient= :prenomPatient, dateNaissance= :dateNaissance, adresse= :adresse, ville= :ville, cp= :cp,  tel= :tel, mail= :mail WHERE login = :login";


		$req = $bd->prepare($txt);

		$req->bindValue(':nomPatient', $nomPatient);
		$req->bindValue(':prenomPatient', $prenomPatient);
		$req->bindValue(':dateNaissance', $dateNaissance);
		$req->bindValue(':adresse', $adresse);
		$req->bindValue(':ville', $ville);
		$req->bindValue(':cp', $cp);
		$req->bindValue(':login', $login);
		$req->bindValue(':mail', $mail);
		$req->bindValue(':tel', $tel);
		$req->execute();	
	}

	function updatePassword($mdp, $mdp2){
		$bd = spdo::getDB ();

		
				$txt = "UPDATE Patient SET mdp= :nouvmdp WHERE login=:login";
				$req = $bd->prepare($txt); 
				$req->bindValue(':nouvmdp', $nouvmdp);
				$req->bindValue(':login', $login);
				$req->execute();

			

	
?>