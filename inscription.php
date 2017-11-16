<?php
session_start();
require_once('fonctions.php');
require_once('debut.php');
if (isset($_SESSION['categorie']) && $_SESSION['categorie'] == 'medecin') {

?>
<div class="container">


<div class="form-group">
<form action="inscription.php" method="post">
	<p> Nom <input type="text" name="nom" class="form-control"/> </p>
	<p> Prénom <input type="text" name="prenom"  class="form-control"/> </p>
	<p> Date de naissance <input type="text" name="datenaissance" class="form-control"/> </p>
	<p> Adresse <input type="text" name="adresse"  class="form-control"/> </p>
	<p> Code postal <input type="text" name="cp" class="form-control" /> </p>
	<p> Ville <input type="text" name="ville"  class="form-control"/> </p>
	<p> Téléphone <input type="text" name="tel"  class="form-control"/> </p>
	<p> Mail <input type="text" name="mail" class="form-control" id="mail" /> </p>
	<p> <input type="submit" value="Modifier" class="btn btn-info" action="<?php $inscription = inscriptionPatient();?>" /> </p>
</form>
</div>
</div>

<?php
	if (isset($_POST['nom']) && trim($_POST['nom']) != '') {
		if($inscription){
			echo '<p> Inscription affectuée avec succès.</p>' ;
		} else {
			echo '<p> Inscription non valide - Veuillez Rééssayer.</p>' ;
		}
	}

}
?>