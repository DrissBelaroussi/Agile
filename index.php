<?php
session_start();
require_once('SPDO.php');
require_once('fonctions.php');
require_once('debut.php');



if (isset($_SESSION['categorie']) && $_SESSION['categorie'] == 'medecin') {
	echo '<p> index medecin </p>' ;

} else if (isset($_SESSION['categorie']) && $_SESSION['categorie'] == 'patient') {

	echo '<p> index medecin </p>' ;
} else {
	header("location: http://google.fr");
	exit;
}	


?>