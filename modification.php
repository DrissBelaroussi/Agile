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
	if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['datenaissance']) && isset($_POST['adresse']) && isset($_POST['ville']) && isset($_POST['tel']) && isset($_POST['mail']) && isset($_POST['cp']) && isset($_POST['mdp']))
	{
		$nomPatient = $_POST['nom'];
		$prenomPatient = $_POST['prenom'];
		$dateNaissance = $_POST['datenaissance'];
		$adresse = $_POST['adresse'];
		$ville = $_POST['ville'];
		$cp = $_POST['cp'];
		$mail = $_POST['mail'];
		$login = $_SESSION['login'];
		$mdp = $_POST['mdp'];
		$txt ="UPDATE Patient SET nomPatient = :nomPatient, prenomPatient= :prenomPatient, dateNaissance= :dateNaissance, adresse= :adresse, ville= :ville, cp= :cp,  tel= :tel, mail= :mail WHERE login = :login AND mdp = :mdp";
		$req = $bd->prepare($txt);
		$req->bindValue(':nomPatient', $nomPatient);
		$req->bindValue(':prenomPatient', $prenomPatient);
		$req->bindValue(':dateNaissance', $dateNaissance);
		$req->bindValue(':adresse', $adresse);
		$req->bindValue(':ville', $ville);
		$req->bindValue(':cp', $cp);
		$req->bindValue(':mail', $mail);
		$req->bindValue(':login', $login);
		$req->bindValue(':mdp', $mdp);
		$req->execute();
		if(isset($_POST['nouvmdp']) && isset($_POST['nouvmdp2'])){
			$nouvmdp = $_POST['nouvmdp'];
			$nouvmdp2 = $_POST['nouvmdp2'];
			if($nouvmdp === $nouvmdp2){
				$txt = "UPDATE Patient SET mdp= :nouvmdp WHERE login=:login";
				$req = $bd->prepare($txt); 
				$req->bindValue(':nouvmdp', $nouvmdp);
				$req->bindValue(':login', $login);
			}
		}
	}
	else{
		var_dump($_POST);
	}
	
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
	if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['datenaissance']) && isset($_POST['adresse']) && isset($_POST['ville']) && isset($_POST['tel']) && isset($_POST['mail']) && isset($_POST['cp']) && isset($_POST['mdp']))
	{
		$nomMedecin = $_POST['nom'];
		$prenomMedecin = $_POST['prenom'];
		$dateNaissance = $_POST['datenaissance'];
		$adresse = $_POST['adresse'];
		$ville = $_POST['ville'];
		$cp = $_POST['cp'];
		$mail = $_POST['mail'];
		$login = $_SESSION['login'];
		$mdp = $_POST['mdp'];
		$txt ="UPDATE Patient SET nomMedecin= :nomMedecin, prenomMedecin = :prenomMedecin, dateNaissance= :dateNaissance, adresseCabinet= :adresse, villeCabinet= :ville, cpCabinet= :cp,  tel= :tel, mail= :mail WHERE login = :login AND mdp = :mdp";
		$req = $bd->prepare($txt);
		$req->bindValue(':nomMedecin', $nomMedecin);
		$req->bindValue(':prenomMedecin', $prenomMedecin);
		$req->bindValue(':dateNaissance', $dateNaissance);
		$req->bindValue(':adresse', $adresse);
		$req->bindValue(':ville', $ville);
		$req->bindValue(':cp', $cp);
		$req->bindValue(':mail', $mail);
		$req->bindValue(':login', $login);
		$req->bindValue(':mdp', $mdp);
		$req->execute();
		if(isset($_POST['nouvmdp']) && isset($_POST['nouvmdp2'])){
			$nouvmdp = $_POST['nouvmdp'];
			$nouvmdp2 = $_POST['nouvmdp2'];
			if($nouvmdp === $nouvmdp2){
				$txt = "UPDATE Patient SET mdp= :nouvmdp WHERE login=:login";
				$req = $bd->prepare($txt); 
				$req->bindValue(':nouvmdp', $nouvmdp);
				$req->bindValue(':login', $login);
			}
		}
	}
	else{
		var_dump($_POST);
	}
}
?>