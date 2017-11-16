<?php
session_start();
require_once('SPDO.php');
require_once('debut.php');
require_once('fonctions.php');
?>

<form name="recherchepatient" method="POST" action="consulterPatients.php">
	<label> Nom du Patient </label>
	<input type="text" name="nompatient"/>
	<input type="submit" value="Rechercher"/>
</form>


<?php
	if(isset($_POST['nompatient'])){
		$patients = getPatients($_POST['nompatient']);
?>

	<table>

		<th>Id</th>
		<th>Nom</th>
		<th>Prénom</th>
		<th>Adresse</th>
		<th>Ville</th>
		<th>Numéro de téléphone</th>
		<th>Mail</th>
		<th></th>

		<?php
			foreach($patients as $unPatient){

				echo "<tr><td>".$unPatient['idPatient']."</td>";
				echo "<td>".$unPatient['nomPatient']."</td>";
				echo "<td>".$unPatient['prenomPatient']."</td>";
				echo "<td>".$unPatient['adresse']."</td>";
				echo "<td>".$unPatient['ville']."</td>";
				echo "<td>".$unPatient['tel']."</td>";
				echo "<td>".$unPatient['mail']."</td>";

			?>

				 <td><form method='POST'>
						<input type='submit' value='Rediger Compte rendu' action="redigercompterendu.php"/>
					</form>
				</td></tr>
		<?php
			}
		?>



	</table>
<?php
	}
?>