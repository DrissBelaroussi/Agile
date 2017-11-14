<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <title>MediDOC</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

<?php
session_start();
require_once('SPDO.php'); 
require_once('fonctions.php'); 

if(isset($_GET['deconnexion'])){
	deconnexion() ;
}
?>

<h1> Connexion </h1>


<form action='connexion.php' method="post">
	<p> Login <input type="text" name="login"/> </p>
	<p> Mot de passe <input type="password" name="mdp"/> </p>
	<p> <button class="btn btn-info" type="submit" action=<?php $msg = connexion() ; ?> /> Connexion </p>
</form>

<?php
	
	
		echo '<p>'.$msg.'</p>' ;
		if (isset($_SESSION['login']) && $_SESSION['login'] != '') {
			echo '<p>'. $_SESSION['login'] .'</p>' ;
?>

			<meta http-equiv="Refresh" content="0;url=index.php"> 
<?php
		}
	
?>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
