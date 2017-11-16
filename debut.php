<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
         <link rel="stylesheet" href="style.css" />
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <title>MediDOC</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
<?php


if (isset($_SESSION['categorie']) && $_SESSION['categorie'] == 'medecin') {
	
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">MediDOC</a>
    </div>
    <ul class="nav navbar-nav">
     <li class="active"> <a href="index.php">Accueil</a></li>
		<li><a href="inscription.php">Nouveau Patient</a></li>
		<li><a href="consulterPatients.php">Les Patients</a></li>
		<li><a href="connexion.php?deconnexion"> Déconnexion</a></li>
    </ul>
  </div>
</nav>
		



<?php


} else if (isset($_SESSION['categorie']) && $_SESSION['categorie'] == 'patient') {
?>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">MediDOC</a>
    </div>
    <ul class="nav navbar-nav">
     <li class="active"> <a href="index.php">Accueil</a></li>
		<li><a href="modification.php"> Modifier Informations Personnelles</a></li>
		<li><a href="rendezvous.php">Prendre un RDV</a></li>
		<li><a href="connexion.php?deconnexion"> Déconnexion</a></li>
    </ul>
  </div>
</nav>

<?php
	
} else {
?>

	<meta http-equiv="Refresh" content="0;url=connexion.php"> 
<?php
}

?>


