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
	
	function deconnexion(){
		session_unset() ; 
	}
	
	function inscriptionPatient() {
	try
	{
		$bd = spdo::getDB ();
		if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['datenaissance']) && isset($_POST['adresse']) && isset($_POST['ville']) && isset($_POST['tel']) && isset($_POST['mail']) && isset($_POST['cp']))
		{
			if(trim($_POST['nom']) != '' && trim($_POST['prenom']) != '' && trim($_POST['datenaissance']) != '' && trim($_POST['adresse']) != '' && trim($_POST['ville']) != '' && trim($_POST['tel']) != '' && trim($_POST['mail']) != '' && trim($_POST['cp'])) != ''
			{
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
	}

	function getPatients($nom){
		try
		{
			$bd = SPDO::getDB() ;
			$req = " select * from Patient where nomPatient = :nomPatient ; " ;
			$stmt = $bd->prepare($req);
				$stmt->bindValue(':nomPatient', $nom);
				$stmt->execute();
			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if($res){
				return $res;
			} else {
				return false;
			}
		}
		
		catch (PDOException $e)
		{
			die('<p> La connexion a échoué. Erreur[' . $e->getCode() . '] : ' . $e->getMessage() . '</p>');
		}
	}
	
	function redigerCompteRendu($idPatient, $idMedecin, $contenuCR){
		try
		{
			$stmt = SPDO::getDB() ;
			$req =  "insert into CompteRendu ( idPatient , idMedecin, contenuCompteRendu ) values (:idPatient , :idMedecin , :contenuCR) ; " ;
			$stmt->prepare($req);
				$stmt->bindValue(':idPatient', $idPatient);
				$stmt->bindValue(':idMedecin', $idMedecin);
				$stmt->bindValue(':contenuCR', $contenuCR);
				$stmt->execute();																					   
			return false ;
		}
		
		catch (PDOException $e)
		{
			die('<p> La connexion a échoué. Erreur[' . $e->getCode() . '] : ' . $e->getMessage() . '</p>');
		}
	}
	
	function getCompteRendu($idPatient, $idMedecin, $date){
		try
		{
			$stmt = SPDO::getDB() ;
			$req = " select * from CompteRendu where idPatient = :idPatient and idMedecin = :idMedecin and date = :date ; " ;
			$stmt->prepare($req);
				$stmt->bindValue(':idPatient', $idPatient);
				$stmt->bindValue(':idMedecin', $idMedecin);
				$stmt->bindValue(':date', $date);
				$stmt->execute();
		}
		
		catch (PDOException $e)
		{
			die('<p> La connexion a échoué. Erreur[' . $e->getCode() . '] : ' . $e->getMessage() . '</p>');
		}
	}
	
	function supprimerCompteRendu($idCR){
		try
		{
			$stmt = SPDO::getDB() ;
			$req = "delete from CompteRendu where idCompteRendu = :idCR ; " ;
			$stmt->prepare($req);
				$stmt->bindValue(':idCR', $idCR);
				$stmt->execute();
			return false ;
		}
		
		catch (PDOException $e)
		{
			die('<p> La connexion a échoué. Erreur[' . $e->getCode() . '] : ' . $e->getMessage() . '</p>');
		}
	}
	
	function getRDV($idPatient, $idMedecin, $date ){
		try
		{
			$stmt = SPDO::getDB() ;
			$req = "select * from RDV where idPatient = :idPatient and idMedecin = :idMedecin and date = :date" ;		
			$stmt->bindValue(':idPatient', $idPatient);
				$stmt->bindValue(':idMedecin', $idMedecin);
				$stmt->bindValue(':date', $date);
				$stmt->execute();
			return false ;
		}
		
		catch (PDOException $e)
		{
			die('<p> La connexion a échoué. Erreur[' . $e->getCode() . '] : ' . $e->getMessage() . '</p>');
		}
	}
	
	function accepterRDV( $idRDV ){
		try
		{
			$stmt = SPDO::getDB() ;
			$req = " update RDV set etat = 'A' where idRDV = :idRDV ;" ; 
			$stmt->bindValue(':idRDV', $idRDV);
				$stmt->execute();
			return false;
		}
		
		catch (PDOException $e)
		{
			die('<p> La connexion a échoué. Erreur[' . $e->getCode() . '] : ' . $e->getMessage() . '</p>');
		}
	}
	
	function refuserRDV( $idRDV ){
		try
		{
			$stmt = SPDO::getDB() ;
			$req = " update RDV set etat = 'R' where idRDV = :idRDV ;" ; 
			$stmt->bindValue(':idRDV', $idRDV);
				$stmt->execute();
			return false ;
		}
		
		catch (PDOException $e)
		{
			die('<p> La connexion a échoué. Erreur[' . $e->getCode() . '] : ' . $e->getMessage() . '</p>');
		}
	}


	function updateUser($login, $nomPatient, $prenomPatient, $adresse, $dateNaissance, $ville, $tel, $mail, $cp){
		try
		{
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
		
		catch (PDOException $e)
		{
			die('<p> La connexion a échoué. Erreur[' . $e->getCode() . '] : ' . $e->getMessage() . '</p>');
		}
	}

	function prendreRDV()
	{
		try
		{
			$bd = SPDO::getDB();
			if (isset($_POST['date']) && isset($_POST['nom']) && isset($_POST['prenom']))
			{
				if (trim($_POST['date']) != '' && trim($_POST['nom']) != '' && trim($_POST['prenom']) != '')
				{
					$txt = "select date from RDV where loginPatient = :loginPatient and date = :date";
					$req = $bd->prepare($txt);
					$req->bindValue(':loginPatient', $_SESSION['login']);
					$req->bindValue(':date', $_POST['date']);
					$req->execute();
					$res = $req->fetch(PDO::FETCH_ASSOC);
					if (!res)
					{
						$date = $_POST['date'];
						
						$txt = "select idMedecin from Medecin where nomMedecin = :nomMedecin and prenomMedecin = :prenomMedecin";
						$req = $bd->prepare($txt);
						$req->bindValue(':nomMedecin', $_POST['nom']);
						$req->bindValue(':prenomMedecin', $_POST['prenom']);
						$req->execute();
						$res = $req->fetch(PDO::FETCH_ASSOC);
						if ($res)
						{
							$idMedecin = $res['idMedecin'];
							
							$txt = "select idPatient from Patient where login = :login";
							$req = $bd->prepare($txt);
							$req->bindValue(':login', $_SESSION['login']);
							$req->execute();
							$res = $req->fetch(PDO::FETCH_ASSOC);
							$idPatient = $res['idPatient'];
							
							$txt = "insert into RDV values (:date, :idPatient, :idMedecin, 'C')";
							$req = $bd->prepare($txt);
							$req->bindValue(':date', $date);
							$req->bindValue(':idPatient', $idPatient);
							$req->bindValue(':idMedecin', $idMedecin);
							$req->execute();
							return -1;
						}
						
						else
						{
							return -2;
						}
					}
					
					else
					{
						return -3;
					}
				}
			}
		}
		
		catch (PDOException $e)
		{
			die('<p> La connexion a échoué. Erreur[' . $e->getCode() . '] : ' . $e->getMessage() . '</p>');
		}
	}

	function updatePassword($mdp, $mdp2){
		try
		{
			$bd = spdo::getDB ();
			
			$txt = "UPDATE Patient SET mdp= :nouvmdp WHERE login=:login";
			$req = $bd->prepare($txt); 
			$req->bindValue(':nouvmdp', $nouvmdp);
			$req->bindValue(':login', $login);
			$req->execute();
		}
		
		catch (PDOException $e)
		{
			die('<p> La connexion a échoué. Erreur[' . $e->getCode() . '] : ' . $e->getMessage() . '</p>');
		}
	}		


function getCompteRenduList($idPatient){
	try
	{
		$stmt = SPDO::getDB() ;
		$req = " select * from CompteRendu where idPatient = $idPatient; " ;
		$result = $stmt->query($req);
		while($entree = $result->fetch(PDO::FETCH_ASSOC))
		{
			$comptes_rendu[] = $entree;
		}
		   return $comptes_rendu;
	}

	catch (PDOException $e)
	{
		die('<p> La connexion a échoué. Erreur[' . $e->getCode() . '] : ' . $e->getMessage() . '</p>');
	}
}

function getCompteRendu($idCompteRendu, $idPatient){
	try
	{
		$stmt = SPDO::getDB();
		$req = "select * from CompteRendu WHERE idCompteRendu= :idCompteRendu AND idPatient = :idPatient";
		$stmt->prepare($req);
		$stmt->bindValue(':idCompteRendu', $idCompteRendu);
		$stmt->bindValue(':idPatient', $idPatient);
		$stmt->execute();
		$entree = $result->fetch(PDO::FETCH_ASSOC);
		return $entree;
	}
	
	catch (PDOException $e)
	{
		die('<p> La connexion a échoué. Erreur[' . $e->getCode() . '] : ' . $e->getMessage() . '</p>');
	}	

}
	
?>