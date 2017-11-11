<?php require_once('SPDO.php'); ?>

<h1> Connexion </h1>

<form action="connexion.php" method="post">
	<p> Login <input type="text" name="login"/> </p>
	<p> Mot de passe <input type="password" name="mdp"/> </p>
	<!-- <input type="radio" name="fonction" value="medecin"/>Médecin
	<input type="radio" name="fonction" value="patient"/>Patient -->
	<p> <input type="submit" value="Connexion"/> </p>
</form>

<?php
/*
if (isset($_POST['login']) && isset($_POST['mdp']) && trim($_POST['login']) != '' && trim($_POST['mdp']) != '')
{
	try
	{
		$bd = spdo::getDB ();
		
		if ($_POST['fonction'] == 'medecin')
		{
			$txt = 'SELECT mdp FROM MEDECIN WHERE login = :login';
		}
		
		else if ($_POST['fonction'] == 'patient')
		{
			$txt = 'SELECT mdp FROM PATIENT WHERE login = :login';
		}
		$req = $bd->prepare($txt);
		$req->bindValue(':login', $_POST['login']);
		$req->execute();
		$res = $req->fetch(PDO::FETCH_ASSOC);
		if ($res)
		{
			if ($_POST['mdp'] = $res['mdp'])
			{
				if ($_POST['fonction'] == 'medecin')
				{
					$txt = 'SELECT nomMedecin, prenomMedecin FROM MEDECIN WHERE login = :login';
				}
				
				else if ($_POST['fonction'] == 'patient')
				{
					$txt = 'SELECT nomPatient, prenomPatient FROM PATIENT WHERE login = :login';
				}
				
				$req = $bd->prepare($txt);
				$req->bindValue(':login', $_POST['login']);
				$req->execute();
				$res2 = $req->fetch(PDO::FETCH_NUM);
				$_SESSION['nom'] = $res2[0];
				$_SESSION['prenom'] = $res2[1];
				$_SESSION['fonction'] = $_POST['fonction'];
				$_SESSION['connecte'] = true;
			}
		}
	}
	
	catch (PDOException $e)
	{
		die('<p> La connexion a échoué. Erreur[' . $e->getCode() . '] : ' . $e->getMessage() . '</p>');
	}
}
*/

if (isset($_POST['login']) && isset($_POST['mdp']) && trim($_POST['login']) != '' && trim($_POST['mdp']) != '')
{
	try
	{
		$bd = spdo::getDB ();
		
		$txt = 'SELECT mdp FROM Medecin WHERE login = :login';
		$req1 = $bd->prepare($txt);
		$req1->bindValue(':login', $_POST['login']);
		$req1->execute();
		$res1 = $req1->fetch(PDO::FETCH_ASSOC);
		
		$txt = 'SELECT mdp FROM Patient WHERE login = :login';
		$req2 = $bd->prepare($txt);
		$req2->bindValue(':login', $_POST['login']);
		$req2->execute();
		$res2 = $req2->fetch(PDO::FETCH_ASSOC);
		
		if ($res1)
		{
			if ($_POST['mdp'] = $res1['mdp'])
			{
				$txt = 'SELECT nomMedecin, prenomMedecin FROM Medecin WHERE login = :login';
				$req = $bd->prepare($txt);
				$req->bindValue(':login', $_POST['login']);
				$req->execute();
				$res = $req->fetch(PDO::FETCH_NUM);
				$_SESSION['nom'] = $res[0];
				$_SESSION['prenom'] = $res[1];
				$_SESSION['connecte'] = true;
				echo 'Connexion réussie';
				var_dump($_SESSION);
			}
		}
		
		else if ($res2)
		{
			if ($_POST['mdp'] = $res2['mdp'])
			{
				$txt = 'SELECT nomPatient, prenomPatient FROM Patient WHERE login = :login';
				$req = $bd->prepare($txt);
				$req->bindValue(':login', $_POST['login']);
				$req->execute();
				$res = $req->fetch(PDO::FETCH_NUM);
				$_SESSION['nom'] = $res[0];
				$_SESSION['prenom'] = $res[1];
				$_SESSION['connecte'] = true;
				echo 'Connexion réussie';
				var_dump($_SESSION);
			}
		}
	}
	
	catch (PDOException $e)
	{
		die('<p> La connexion a échoué. Erreur[' . $e->getCode() . '] : ' . $e->getMessage() . '</p>');
	}
}
?>