<?php
session_start();
require_once('SPDO.php');
require_once('fonctions.php'); 
require_once('debut.php'); 
?>

<div class="container">

<div class="form-group">
	<form action="rendezvous.php" method="post">
		<p> Date de rendez-vous <input type="text" name="date"  class="form-control"/> </p>
		<p> Nom du médecin <input type="text" name="nom"  class="form-control"/> </p>
		<p> Prénom du médecin <input type="text" name="prenom"  class="form-control"/> </p>
		<p> <input type="submit" value="Valider" class="btn btn-info"/> </p>
	</form>
</div>
</div>
	
	<?php
	$rdv = prendreRDV();
	switch ($rdv)
	{
		case -1 : echo "Rendez-vous enregistré"; break;
		case -2 : echo "Les données du médecin ne sont pas valides"; break;
	}
	?>