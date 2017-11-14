<?php

require_once ('SPDO.php') ;

echo "bonjour";

    function connexion(){

	if (isset($_POST['login']) && isset($_POST['mdp']) && trim($_POST['login']) != '' && trim($_POST['mdp']) != '')
	{
		try
		{
			$bd = spdo::getDB ();
					$medecin = false ;
					$patient = false ; 

					$txt = 'SELECT nomMedecin, prenomMedecin, login FROM Medecin WHERE login = :login and mdp =:mdp' ;
					$req = $bd->prepare($txt);
					$req->bindValue(':login', $_POST['login']);
					$req->bindValue(':mdp', $_POST['mdp']);
					$req->execute();
					$res1 = $req->fetch(PDO::FETCH_ASSOC);
					

					$txt = 'SELECT nomPatient, prenomPatient, login FROM Patient WHERE login = :login and mdp =:mdp';
					$req = $bd->prepare($txt);
					$req->bindValue(':login', $_POST['login']);
					$req->bindValue(':mdp', $_POST['mdp']);
					$req->execute();
					$res2 = $req->fetch(PDO::FETCH_ASSOC);
					

					if($res1){
						$medecin = true ;
					
						$_SESSION['nom'] = $res1['nomMedecin'];
						$_SESSION['prenom'] = $res1['prenomMedecin'];
						$_SESSION['login'] = $res1['login'];
						$_SESSION['categorie'] = 'medecin';
						$_SESSION['connecte'] = true;	
						$msg = "Connexion Medecin réussie - Bienvenue ". $_SESSION['prenom'] ;			
						var_dump($_SESSION);
					} elseif($res2){
						$patient = true ; 
						$_SESSION['nom'] = $res2['nomPatient'];
						$_SESSION['prenom'] = $res2['prenomPatient'];
						$_SESSION['login'] = $res1['login'];
						$_SESSION['categorie'] = 'patient';
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
	
	function inscriptionPatient($tableau) {
		return false ;
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


echo "au revoir";
	
?>