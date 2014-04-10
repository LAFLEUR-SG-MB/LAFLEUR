<?php
include 'secret/identifiants.php';
		try {
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			$bdd = new PDO('mysql:host='.$ServeurBDD.';dbname='.$nomBDD, $utilBDD, $mdpUtilBDD);
			$reponseReq = $bdd->query('SELECT * FROM produits');
			echo '<table>';
			echo '<tr><td>modifier</td><td>supprimer</td><td>nom</td><td>sous_titre</td><td>definition</td><td>prix</td><td>image</td><td>categorie</td>';
			echo '</tr>';
			while ( $donnees = $reponseReq->fetch() ){
				echo '<tr>';
				echo '<td><a href="admin.php?idModif='.$donnees['produit_id'].'"><img src="img/modif.gif" alt="modifier"/></a></td>';
				echo '<td><a href="admin.php?idEfface='.$donnees['produit_id'].'"><img src="img/suppr.jpg" alt="modifier"/></a></td>';
				echo '<td>'.$donnees['nom'].'</td>';
				echo '<td>'.$donnees['sous_titre'].'</td>';
				echo '<td>'.$donnees['definition'].'</td>';
				echo '<td>'.$donnees['prix'].'</td>';
				echo '<td><img style="width:150px" src="image_s/produits/'.$donnees['image'].'"/></td>';
				echo '<td>'.$donnees['categorie'].'</td>';

				echo '</tr>';
			}
			echo '</table>';
		}
		catch (Exception $erreur) {
			die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
		}
?>