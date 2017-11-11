<?php

require_once 'SPDO.php' ;

echo "bonjour";
	
	function connexion($login,$mdp){
		return false ; 
	}
	
	function deconnexion($login){
		return false ; 
	}
	
	function inscriptionPatient($tableau) {
		return false ;
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
echo "au revoir";
	
?>