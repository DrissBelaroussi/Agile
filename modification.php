<?php require_once('SPDO.php');
session_start();

if ($_SESSION['categorie'] == 'patient')
{
	$txt = 'SELECT * FROM PATIENT WHERE login = :login';
}

else if ($_SESSION['categorie'] == 'medecin')
{
	$txt = 'SELECT * FROM MEDECIN WHERE login = :login';
}

$req = $bd->prepare($txt);
$req->bindValue(':login', $_SESSION['login']);
$req->execute();
$res = $req->fetch(PDO::FETCH_ASSOC);

if ($_SESSION['categorie'] == 'patient')
{	?>

<form action="modification.php" method="post">
	<p> Nom <input type="text" name="nom" value=" <?php $res['nomPatient'] ?>"/> </p>
	<p> Prénom <input type="text" name="prenom" value="<?php $res['prenomPatient'] ?>"/> </p>
	<p> Date de naissance <input type="text" name="datenaissance" value="<?php $res['dateNaissance'] ?>"/> </p>
	<p> Adresse <input type="text" name="adresse" value="<?php $res['adresse'] ?>"/> </p>
	<p> Code postal <input type="text" name="cp" value="<?php $res['cp'] ?>"/> </p>
	<p> Ville <input type="text" name="ville" value="<?php $res['ville'] ?>"/> </p>
	<p> Téléphone <input type="text" name="tel" value="<?php $res['tel'] ?>"/> </p>
	<p> Mail <input type="text" name="mail" value="<?php $res['mail'] ?>"/> </p>
	<p> Nouveau mot de passe (optionnel) <input type="password" name="nouvmdp"/> </p>
	<p> Re-entrer le nouveau mot de passe <input type="password" name="nouvmdp2"/> </p>
	<p> Mot de passe actuel <input type="password" name="mdp"/> </p>
	<p> <input type="submit" value="Modifier"/> </p>
</form>

<?php else if ($_SESSION['categorie'] == 'medecin')
{	?>

<form action="modification.php" method="post">
	<p> Nom <input type="text" name="nom" value=" <?php $res['nomMedecin'] ?>"/> </p>
	<p> Prénom <input type="text" name="prenom" value="<?php $res['prenomMedecin'] ?>"/> </p>
	<p> Date de naissance <input type="text" name="datenaissance" value="<?php $res['dateNaissance'] ?>"/> </p>
	<p> Adresse <input type="text" name="adresse" value="<?php $res['adresseCabinet'] ?>"/> </p>
	<p> Code postal <input type="text" name="cp" value="<?php $res['cpCabinet'] ?>"/> </p>
	<p> Ville <input type="text" name="ville" value="<?php $res['villeCabinet'] ?>"/> </p>
	<p> Téléphone <input type="text" name="tel" value="<?php $res['tel'] ?>"/> </p>
	<p> Mail <input type="text" name="mail" value="<?php $res['mail'] ?>"/> </p>
	<p> Nouveau mot de passe (optionnel) <input type="password" name="nouvmdp"/> </p>
	<p> Re-entrer le nouveau mot de passe <input type="password" name="nouvmdp2"/> </p>
	<p> Mot de passe actuel <input type="password" name="mdp"/> </p>
	<p> <input type="submit" value="Modifier"/> </p>
</form>

<?php } ?>