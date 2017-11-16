<?phpsession_start();
require_once('SPDO.php');
require_once('fonctions.php'); ?>


	<form action="rendezvous.php" method="post">
	<p> Date de rendez-vous <input type="text" name="date"/> </p>
	<p> Nom du médecin <input type="text" name="nom"/> </p>
	<p> Prénom du médecin <input type="text" name="prenom"/> </p>
	<p> <input type="submit" value="Valider"/> </p>
	</form>
	
	<?php
	$rdv = prendreRDV();
	switch ($rdv)
	{
		case -1 : echo "Rendez-vous enregistré"; break;
		case -2 : echo "Les données du médecin ne sont pas valides"; break;
	}
	?>