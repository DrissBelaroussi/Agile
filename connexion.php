<?php
session_start();
require_once('SPDO.php'); 
require_once('fonctions.php'); 

?>

<h1> Connexion </h1>


<form action='connexion.php' method="post">
	<p> Login <input type="text" name="login"/> </p>
	<p> Mot de passe <input type="password" name="mdp"/> </p>
	<p> <input type="submit" value="Connexion" action=<?php $msg = connexion() ; ?> /> </p>
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
