<?php require_once('spdo.php'); ?>

<form action="formulaire.php" action="post">
	<p> Login <input type="text" name="login"/>
	<p> Mot de passe <input type="hidden" name="mdp"/>
	<!-- <input type="radio" name="fonction" value="medecin"/>Médecin
	<input type="radio" name="fonction" value="patient"/>Patient -->
	<input type="submit" value="Connexion"/>
</form>

<?php
/*
if (isset($_POST['login']) && isset($_POST['mdp']) && trim($_POST['login']) != '' && trim($_POST['mdp']) != '')
{
	try
	{
		if ($_POST['fonction'] == 'medecin')
		{
			$txt = 'SELECT mdp FROM MEDECIN WHERE login = :login';
		}
		
		else if ($_POST['fonction'] == 'patient')
		{
			$txt = 'SELECT mdp FROM PATIENT WHERE login = :login';
		}
		$req->prepare($txt);
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
				
				$req->prepare($txt);
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
		die('<p> La connexion a échoué. Erreur[' . $e->getCode() . '] : ' . $e->getMessage() . '</p>';
	}
}
*/

if (isset($_POST['login']) && isset($_POST['mdp']) && trim($_POST['login']) != '' && trim($_POST['mdp']) != '')
{
	try
	{
		$txt = 'SELECT mdp FROM MEDECIN WHERE login = :login';
		$req1->prepare($txt);
		$req1->bindValue(':login', $_POST['login']);
		$req1->execute();
		$res1 = $req1->fetch(PDO::FETCH_ASSOC);
		
		$txt = 'SELECT mdp FROM PATIENT WHERE login = :login';
		$req2->prepare($txt);
		$req2->bindValue(':login', $_POST['login']);
		$req2->execute();
		$res2 = $req2->fetch(PDO::FETCH_ASSOC);
		
		if ($res1)
		{
			if ($_POST['mdp'] = $res1['mdp'])
			{
				$txt = 'SELECT nomMedecin, prenomMedecin FROM MEDECIN WHERE login = :login';
				$req->prepare($txt);
				$req->bindValue(':login', $_POST['login']);
				$req->execute();
				$res = $req->fetch(PDO::FETCH_NUM);
				$_SESSION['nom'] = $res[0];
				$_SESSION['prenom'] = $res[1];
				$_SESSION['connecte'] = true;
			}
		}
		
		else if ($res2)
		{
			if ($_POST['mdp'] = $res2['mdp'])
			{
				$txt = 'SELECT nomPatient, prenomPatient FROM PATIENT WHERE login = :login';
				$req->prepare($txt);
				$req->bindValue(':login', $_POST['login']);
				$req->execute();
				$res = $req->fetch(PDO::FETCH_NUM);
				$_SESSION['nom'] = $res[0];
				$_SESSION['prenom'] = $res[1];
				$_SESSION['connecte'] = true;
			}
		}
	}
	
	catch (PDOException $e)
	{
		die('<p> La connexion a échoué. Erreur[' . $e->getCode() . '] : ' . $e->getMessage() . '</p>';
	}
}
?>