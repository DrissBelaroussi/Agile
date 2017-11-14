<?php


if (isset($_SESSION['categorie']) && $_SESSION['categorie'] == 'medecin') {
	echo '<p> En tete medecin </p>' ;
?>
	<ul id="menu_horizontal">
		<li><a href="index.php">Accueil</a></li>
		<li><a href="inscription.php">Nouveau Patient</a></li>
	</ul>

<?php
} else if (isset($_SESSION['categorie']) && $_SESSION['categorie'] == 'patient') {
?>

	<ul id="menu_horizontal">
		<li><a href="index.php">Accueil</a></li>
		<li><a href="modification.php"> Modifier Informations Personnelles</a></li>
	</ul>

<?php
	echo '<p> En tete medecin </p>' ;
} else {
	
}

?>


