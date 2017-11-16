<?php 
session_start();
require_once('SPDO.php');
require_once('fonctions.php');
require_once('debut.php') ;
echo '<p></p>' ;
if ($_SESSION['categorie'] == 'patient')
{
	$bd = spdo::getDB ();
	$txt = 'SELECT * FROM Patient WHERE login = :login';
	$req = $bd->prepare($txt);
	$req->bindValue(':login', $_SESSION['login']);
	$req->execute();
	$res = $req->fetch(PDO::FETCH_ASSOC);
?>

<div class="container">
	<div class="form-group">
	<form action="modification.php" method="post">
	<p> Nom <input type="text" name="nom" class="form-control" value="<?php echo $res['nomPatient'] ?>"/> </p>
	<p> Prénom <input type="text" name="prenom" class="form-control" value="<?php echo $res['prenomPatient'] ?>"/> </p>
	<p> Date de naissance <input type="text" name="datenaissance"  class="form-control" value="<?php echo $res['dateNaissance'] ?>"/> </p>
	<p> Adresse <input type="text" name="adresse"  class="form-control" value="<?php echo $res['adresse'] ?>"/> </p>
	<p> Code postal <input type="text" name="cp" class="form-control"  value="<?php echo $res['cp'] ?>"/> </p>
	<p> Ville <input type="text" name="ville"  class="form-control" value="<?php echo $res['ville'] ?>"/> </p>
	<p> Téléphone <input type="text" name="tel" class="form-control"  value="<?php echo $res['tel'] ?>"/> </p>
	<p> Mail <input type="text" name="mail"  class="form-control" value="<?php echo $res['mail'] ?>"/> </p>
	<p> Nouveau mot de passe (optionnel) <input type="password"  class="form-control" id="pwd" name="nouvmdp"/> </p>
	<p> Re-entrer le nouveau mot de passe <input type="password"  class="form-control" id="pwd" name="nouvmdp2"/> </p>
	<p> Mot de passe actuel <input type="password"  class="form-control" id="pwd" name="mdp"/> </p> 
	<p> <input type="submit"  class="btn btn-info"  value="Modifier"/> </p>
	</form>
</div>
</div>

<?php
if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['datenaissance']) && isset($_POST['adresse']) && isset($_POST['ville']) && isset($_POST['tel']) && isset($_POST['mail']) && isset($_POST['cp']))
	{
		$login = $_SESSION['login'];
		$nomPatient = $_POST['nom'];
		$prenomPatient = $_POST['prenom'];
		$dateNaissance = $_POST['datenaissance'];
		$adresse = $_POST['adresse'];
		$ville = $_POST['ville'];
		$cp = $_POST['cp'];
		$tel = $_POST['tel'];
		$mail = $_POST['mail'];
		updateUser($login, $nomPatient, $prenomPatient, $adresse, $dateNaissance, $ville, $tel, $mail, $cp);
		if(isset($_POST['nouvmdp']) && isset($_POST['nouvmdp2']) && $_POST['nouvmdp'] != '' ){
			$nouvmdp = $_POST['nouvmdp'];
			$nouvmdp2 = $_POST['nouvmdp2'];
			if($nouvmdp === $nouvmdp2 ){
				updatePassword($nouvmdp, $_POST['mdp']);
			}
		}
	}
else{
	
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
	<label> Nom</label> <input type="text" name="nom" value="<?php echo $res['nomMedecin'] ; ?>" /> 
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
if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['datenaissance']) && isset($_POST['adresse']) && isset($_POST['ville']) && isset($_POST['tel']) && isset($_POST['mail']) && isset($_POST['cp']))
	{
		$login = $_SESSION['login'];
		$nomMedecin = $_POST['nom'];
		$prenomMedecin = $_POST['prenom'];
		$dateNaissance = $_POST['datenaissance'];
		$adresse = $_POST['adresseCabinet'];
		$ville = $_POST['villeCabinet'];
		$cp = $_POST['cpCabinet'];
		$tel = $_POST['tel'];
		$mail = $_POST['mail'];
		updateUser($login, $nomMedecin, $prenomMedecin, $adresse, $dateNaissance, $ville, $tel, $mail, $cp);
		if(isset($_POST['nouvmdp']) && isset($_POST['nouvmdp2']) && $_POST['nouvmdp'] != '' ){
			$nouvmdp = $_POST['nouvmdp'];
			$nouvmdp2 = $_POST['nouvmdp2'];
			if($nouvmdp === $nouvmdp2 ){
				updatePassword($nouvmdp, $_POST['mdp']);
			}
		}
	}
else{
	
}
}

require_once('fin.php') ;
?>