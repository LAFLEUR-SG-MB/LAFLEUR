<?php
include 'secret/identifiants.php';
		echo '<form method="post" action="admin.php" id="ajout">
				Nom:<input type="text"name="nom"/><br/>
				rue:<input type="text" name="rue"/><br/>
				cp:<input type="text"name="cp"/><br/>
				ville:<input type="texte" name="ville" /><br/>
				telephone:<input type="text" name="telephone" /><br/>
				horaires:<input type="text" name="horaires" /><br/>
				<br/>
				<input type="reset" name="effacer" />	
				<input type="submit" name="créer" />
			</form>';
		try {
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			$bdd = new PDO('mysql:host='.$ServeurBDD.';dbname='.$nomBDD, $utilBDD, $mdpUtilBDD);
			$reponseReq = $bdd->query('SELECT * FROM boutiques');
			echo '<table>';
			echo '<tr><td>modifier</td><td>supprimer</td><td>nom</td><td>rue</td><td>cp</td><td>ville</td><td>image</td><td>telephone</td>';
			echo '<td>horaires</td></tr>';
			while ( $donnees = $reponseReq->fetch() ){
				echo '<tr>';
				echo '<td><a href="admin.php?idModif='.$donnees['id'].'"><img src="img/modif.gif" alt="modifier"/></a></td>';
				echo '<td><a href="admin.php?idEfface='.$donnees['id'].'"><img src="img/suppr.jpg" alt="modifier"/></a></td>';
				echo '<td>'.$donnees['nom'].'</td>';
				echo '<td>'.$donnees['rue'].'</td>';
				echo '<td>'.$donnees['cp'].'</td>';
				echo '<td>'.$donnees['ville'].'</td>';
				echo '<td><img style="width:150px" src="image_s/boutiques/boutique_'.$donnees['ville'].'.jpg"/></td>';
				echo '<td>'.$donnees['telephone'].'</td>';
				echo '<td>'.$donnees['horaires'].'</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
		catch (Exception $erreur) {
			die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
		}
?>