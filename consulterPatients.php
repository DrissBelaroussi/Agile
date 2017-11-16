<?php
session_start();
require_once('SPDO.php');
require_once('debut.php');
require_once('fonctions.php');
?>

<form name="recherchepatient" method="POST" action="consulterPatients.php">
	<label> Nom du Patient </label>
	<input type="text" name="nompatient"/>
	<input type="submit" value="Rechercher" class="btn btn-info" />
</form>
</br>

<?php
	if(isset($_POST['nompatient'])){
		$patients = getPatients($_POST['nompatient']);
?>
<div class="container">

	<table class="table">

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
				$id = $unPatient['idPatient'] ; 
				echo "<tr><td>".$unPatient['idPatient']."</td>";
				echo "<td>".$unPatient['nomPatient']."</td>";
				echo "<td>".$unPatient['prenomPatient']."</td>";
				echo "<td>".$unPatient['adresse']."</td>";
				echo "<td>".$unPatient['ville']."</td>";
				echo "<td>".$unPatient['tel']."</td>";
				echo "<td>".$unPatient['mail']."</td>";

		?>

				<td>
				 	<form action="redigercompterendu.php" method="POST">
				 		<input type="hidden" name="idPatient" value="<?php echo $id ; ?>" />
						<input type="submit" value="Rediger Compte rendu" class="btn btn-info" />
					</form>
				</td></tr>
		<?php

			}

		?>



	</table>
</div>
<?php
	}
?>