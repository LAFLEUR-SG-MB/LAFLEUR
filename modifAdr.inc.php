<?php
include 'secret/identifiants.php';
?>	
	<?php
		try {
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			$bdd = new PDO('mysql:host='.$ServeurBDD.';dbname='.$nomBDD, $utilBDD, $mdpUtilBDD);
			$reponseReq = $bdd->query('SELECT * FROM boutiques');
			echo '<table>';
			echo '<tr><td>modifier</td><td>supprimer</td><td>nom</td><td>rue</td><td>cp</td><td>ville</td><td>image</td><td>telephone</td><td>horaires</td>';
			echo '</tr>';
			while ( $donnees = $reponseReq->fetch() ){
				echo '<tr>';
				echo '<td><a href="admin.php?idModif='.$donnees['id'].'"><img src="img/modif.gif" alt="modifier"/></a></td>';
				echo '<td><a href="admin.php?idEfface='.$donnees['id'].'"><img src="img/suppr.jpg" alt="modifier"/></a></td>';
				echo '<td>'.$donnees['nom'].'</td>';
				echo '<td>'.$donnees['rue'].'</td>';
				echo '<td>'.$donnees['cp'].'</td>';
				echo '<td>'.$donnees['ville'].'</td>';
				echo '<td><img style="width:150px" src="image_s/boutiques/'.$donnees['image'].'"/></td>';
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
							
							<br/>
							<form method="post" action="adminGeneral.php" id="ajout">
								Nom:<input type="text" name="nom"/><br/>
								rue:<input type="text" name="rue"/><br/>
								cp:<input type="text"name="cp"/><br/>
								ville:<input type="text" name="ville"/><br/>
								Votre image à mettre en ligne : <input type="file" id="image" name="image" />
								telephone:<input type="text" name="telephone"/><br/>
								horaires:<input type="text" name="horaires"/><br/>
								<input type="reset" name="effacer" />	
								<input type="submit" name="créer" />
							</form><br/><br/>
							
		<?php
				if ( isset($_GET['idModif']) ){
					$idModif = $_GET['idModif'];
					try {
						$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
						$bdd = new PDO('mysql:host='.$ServeurBDD.';dbname='.$nomBDD, $utilBDD, $mdpUtilBDD);
						$reponseReq = $bdd->prepare('SELECT * FROM boutiques WHERE boutiques = :id');
						$reponseReq->execute( array(
								'id' => $idModif
						));
						$donnees = $reponseReq->fetch();
		?>			
			MODIFIER LES BOUTIQUES !
							<form action="adminGeneral.php" method="post" name="modifier" id="modifier">
								<input type="hidden" name="hdnIdboutique" id="hdnIdboutique" value="<?php echo $donnees['id']; ?>"/>
								Nom : <input type="text" name="nom" id="nom" value="<?php echo $donnees['nom']; ?>"/><br/>
								Rue : <input type="text" name="rue" id="rue" value="<?php echo $donnees['rue']; ?>"/><br/>
								cp : <input type="text" name="cp" id="cp" value="<?php echo $donnees['cp']; ?>"/><br/>
								Choisissez la ville :
								<select name="ville" id="ville">
									<option value="Valence" <?php if (  $donnees['ville'] == 'Valence' ) { echo 'selected="selected"'; } ?>>Valence</option>
									<option value="Grenoble" <?php if ( $donnees['ville'] == 'Grenoble' ) { echo 'selected="selected"'; } ?>>Grenoble</option>
									<option value="Lyon" <?php if ( $donnees['ville'] == 'Lyon' ) { echo 'selected="selected"'; } ?>>Lyon</option>
									<option value="Chambery" <?php if (  $donnees['ville'] == 'Chambery' ) { echo 'selected="selected"'; } ?>>Chambery</option>
									<option value="Albertville" <?php if ( $donnees['ville'] == 'Albertville' ) { echo 'selected="selected"'; } ?>>Albertville</option>
									<option value="Annecy" <?php if ( $donnees['ville'] == 'Annecy') { echo 'selected="selected"'; } ?>>Annecy</option>
								</select><br/>
								Image : <input type="file" id="image" name="image" value="<?php echo $donnees['image']; ?>"/>
								<input type="reset" name="effacer" />	
								<input type="submit" name="modifier" />		
							</form>
			<?php 			
			}
						catch (Exception $erreur){
							die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
						}
				}
						
			?>
						
				<br/>
						
							
			