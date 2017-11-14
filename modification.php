<?php 
session_start();
require_once('SPDO.php');
require_once('fonctions.php');

echo '<pknkn</p>' ;

if ($_SESSION['categorie'] == 'patient')
{
	$bd = spdo::getDB ();
	$txt = 'SELECT * FROM Patient WHERE login = :login';
	$req = $bd->prepare($txt);
	$req->bindValue(':login', $_SESSION['login']);
	$req->execute();
	$res = $req->fetch(PDO::FETCH_ASSOC);
?>

	<form action="modification.php" method="post">
	<p> Nom <input type="text" name="nom" value="<?php echo $res['nomPatient'] ?>"/> </p>
	<p> Prénom <input type="text" name="prenom" value="<?php echo $res['prenomPatient'] ?>"/> </p>
	<p> Date de naissance <input type="text" name="datenaissance" value="<?php echo $res['dateNaissance'] ?>"/> </p>
	<p> Adresse <input type="text" name="adresse" value="<?php echo $res['adresse'] ?>"/> </p>
	<p> Code postal <input type="text" name="cp" value="<?php echo $res['cp'] ?>"/> </p>
	<p> Ville <input type="text" name="ville" value="<?php echo $res['ville'] ?>"/> </p>
	<p> Téléphone <input type="text" name="tel" value="<?php echo $res['tel'] ?>"/> </p>
	<p> Mail <input type="text" name="mail" value="<?php echo $res['mail'] ?>"/> </p>
	<p> Nouveau mot de passe (optionnel) <input type="password" name="nouvmdp"/> </p>
	<p> Re-entrer le nouveau mot de passe <input type="password" name="nouvmdp2"/> </p>
	<p> Mot de passe actuel <input type="password" name="mdp"/> </p>
	<p> <input type="submit" value="Modifier"/> </p>
</form>
<?php 

} else if ($_SESSION['categorie'] == 'medecin')
{
	$bd = spdo::getDB ();
	$txt = 'SELECT * FROM Medecin WHERE login = :login';
	$req = $bd->prepare($txt);
	$req->bindValue(':login', $_SESSION['login']);
	$req->execute();
	$res = $req->fetch(PDO::FETCH_ASSOC);

	echo '<p>'.print_r($res).'</p>' ;
?>
	<form action="modification.php" method="post">
	<p> Nom <input type="text" name="nom" value="<?php echo $res['nomMedecin'] ; ?>" /> </p>
	<p> Prénom <input type="text" name="prenom" value="<?php  echo $res['prenomMedecin'] ; ?>"/> </p>
	<p> Date de naissance <input type="text" name="datenaissance" value="<?php echo $res['dateNaissance'] ?>"/> </p>
	<p> Adresse <input type="text" name="adresse" value="<?php echo $res['adresseCabinet'] ?>"/> </p>
	<p> Code postal <input type="text" name="cp" value="<?php echo $res['cpCabinet'] ?>"/> </p>
	<p> Ville <input type="text" name="ville" value="<?php  echo $res['villeCabinet'] ?>"/> </p>
	<p> Téléphone <input type="text" name="tel" value="<?php echo $res['tel'] ?>"/> </p>
	<p> Mail <input type="text" name="mail" value="<?php echo $res['mail'] ?>"/> </p>
	<p> Nouveau mot de passe (optionnel) <input type="password" name="nouvmdp"/> </p>
	<p> Re-entrer le nouveau mot de passe <input type="password" name="nouvmdp2"/> </p>
	<p> Mot de passe actuel <input type="password" name="mdp"/> </p>
	<p> <input type="submit" value="Modifier"/> </p>
</form>

<?php
}
?>

