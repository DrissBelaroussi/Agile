<?php
session_start();
 require_once('SPDO.php');
 require_once('debut.php');
 require_once('fonctions.php');

?>
<div class="container">
	<div class="form-group">
<form action="consulterPatients.php" method="post">
	<p>  Compte-Rendu <input type="textarea" name="contenu"  class="form-control" value=""/> </p>
	<p> <input type="submit" value="Envoyer" class="btn btn-info" /></p>
</form>

</div>
</div>

<?php
	if(isset($_POST['contenu'])){
		redigerCompteRendu($_POST['idPatient'], $_SESSION['idMedecin'], $_POST['contenu']);
		echo "Insertion Compte rendu OK" ;
	} else {
		echo 'Insertion Compte rendu ERROR' ;
	}
	
?>