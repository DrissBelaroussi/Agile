<?php
session_start();
require_once('fonctions.php');
require_once('debut.php');
if (isset($_SESSION['categorie']) && $_SESSION['categorie'] == 'medecin') {

?>

<form action="inscription.php" method="post">
	<p> Nom <input type="text" name="nom" /> </p>
	<p> Prénom <input type="text" name="prenom" /> </p>
	<p> Date de naissance <input type="text" name="datenaissance" /> </p>
	<p> Adresse <input type="text" name="adresse" /> </p>
	<p> Code postal <input type="text" name="cp" /> </p>
	<p> Ville <input type="text" name="ville" /> </p>
	<p> Téléphone <input type="text" name="tel" /> </p>
	<p> Mail <input type="text" name="mail" /> </p>
	<p> <input type="submit" value="Modifier" action="<?php $inscription = inscriptionPatient();?>" /> </p>
</form>


<?php
	if (isset($_POST['nom']) && $_POST['nom'] != '') {
		if($inscription){
			echo '<p> Inscription affectuée avec succès.</p>' ;
		} else {
			echo '<p> Inscription non valide - Veuillez Rééssayer.</p>' ;
		}
	}

}
?>