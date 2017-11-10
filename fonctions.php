<?php

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
	
	function redigerCompteRendu($tableau){
		return false ; 
	}
	
	function getCompteRendu($idPatient, $idMedecin, $date){
		
	}
	
	function supprimerCompteRendu($idCR){
		return false ;		
	}
	
	function getRDV($idPatient, $idMedecin, $date ){
		return false ;
	}
	
	function accepterRDV( $idRDV ){
		return false;
	}
	
	function refuserRDV( $idRDV ){
		return false ; 
	}
echo "au revoir";
	
?>