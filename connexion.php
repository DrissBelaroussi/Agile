<?php require_once('SPDO.php'); ?>
<?php require_once('fonctions.php'); ?>

<h1> Connexion </h1>

<form action='connexion.php' method="post">
	<p> Login <input type="text" name="login"/> </p>
	<p> Mot de passe <input type="password" name="mdp"/> </p>
	<!-- <input type="radio" name="fonction" value="medecin"/>Médecin
	<input type="radio" name="fonction" value="patient"/>Patient -->
	<p> <input type="submit" value="Connexion" action=<?php $msg = connexion() ; ?> /> </p>
</form>

<?php
	echo '<p>'.$msg.'</p>' ;
?>
