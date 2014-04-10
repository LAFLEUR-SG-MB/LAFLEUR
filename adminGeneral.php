<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Index</title>
<link rel="stylesheet" type="text/css" media="screen" href="css/cssfleur.css"/>
</head>
						<body background="img/fleurfond.jpg"><p>
					<div class="principal">
					
							<a href="index.php"> <div class="titre" >
										<!-- image de 60px d'hauteur et 100 de largeur --> 
										<img class="gauche" src="img/logo.PNG" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; LAFLEUR

							</div></a>
							
							<div class="colonegauche">
									 <p> 
									 		<h2>Menu</h2></p>
									 		<br/>
									 	<a href="Fleur.php"> <div class="lien"> Nos Fleurs </div></a>
									 	<br/><br/>
									 	<a href="plantes.php"> <div class="lien"> Nos Plantes </div></a>
									 	<br/><br/>
									 	<a href="compositions.php"> <div class="lien"> Compositions </div></a>
									 <br/><br/>
									  <a href="nosboutiques.php"> <div class="lien"> Nos Adresses </div></a>
									 
										
							</div>
							
							
							<div class="corpdusite">
							<br/>
								
								<h2>
								Bienvenue adminGeneral, vous pourrez ici modifier la base de donnée.
								</h2>
								<br/><br/>
							<?php
							include 'secret/identifiants.php';
							$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
							$bdd = new PDO('mysql:host='.$ServeurBDD.';dbname='.$nomBDD, $utilBDD, $mdpUtilBDD);
							?>	
							<?php 
							if (isset ($_POST['modif'])){
								$modif= $_POST['modif'];
								if ($modif == "adr" ){
																
									include 'modifAdr.inc.php';
								}
								elseif ($modif == "produits" ){

									include 'modifProduits.inc.php';
								}
							}
							
							?>
							<form method ="post" action="adminGeneral.php" id="modif" >
									<p> 
									<i>Ici vous pourrez modifier votre site ainsi que la base de donnée.</i><br/>
									<u>Choisissez ce que vous souhaitez modifier, les adresses ou les produits ( compositions, plantes ou fleurs).</U>
									<input type="radio" name="modif" value="adr" /> Les adresses
									<input type="radio" name="modif" value="produits" /> Les produits
									<input type="submit" name="envoie" value="Valider"/>
						
							</form>
							<?php 
								if ( isset($_POST['créer']) ) {
									if ( isset($_POST['nom']) && isset($_POST['rue'])  && isset($_POST['cp']) && isset($_POST['ville']) && isset($_POST['image']) && isset($_POST['telephone']) && isset($_POST['horaires'])) {
										$nom = $_POST['nom'];
										$rue = $_POST['rue'];
										$cp = $_POST['cp'];
										$ville = $_POST['ville'];
										$image = $_FILES['image']['name'];
										$telephone = $_POST['telephone'];
										$horaires = $_POST['horaires'];
										try {
											
											$ajoutReq = $bdd->prepare('INSERT INTO boutiques VALUES (\'\', :nom, :rue, :cp, :ville, :image, :telephone, :horaires)');
											$ajoutReq->execute( array(
													'nom' => $nom,
													'rue' => $rue,
													'cp' => $cp,
													'ville' => $ville,
													'image' => $image,
													'telephone' => $telephone,
													'horaires' => $horaires
											));
											$derniereBoutique = $bdd->lastInsertId();
											echo '<h4>Votre nouvel Boutique a bien été enregistré sous le numéro '.$derniereBoutique.'</h4>';
										}
										catch (Exception $erreur) {
											die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
										}
									}
								}
								if ( isset($_POST['créerP']) ) {
									if ( isset($_POST['nom']) && isset($_POST['sous_titre'])  && isset($_POST['definition']) && isset($_POST['prix']) && isset($_POST['image']) && isset($_POST['categorie'])) {
										$nom = $_POST['nom'];
										$sous_titre = $_POST['sous_titre'];
										$definition = $_POST['definition'];
										$prix = $_POST['prix'];
										$image = $_POST['image'];
										$categorie = $_POST['categorie'];
										try {
											
											$ajoutPReq = $bdd->prepare('INSERT INTO produits VALUES (\'\', :nom, :sous_titre, :definition, :prix, :image, :categorie)');
											$ajoutPReq->execute( array(
													'nom' => $nom,
													'sous_titre' => $sous_titre,
													'definition' => $definition,
													'prix' => $prix,
													'image' => $image,
													'categorie' => $categorie
											));
											$dernierProduit = $bdd->lastInsertId();
											echo '<h4>Votre nouveau produit a bien été enregistré sous le numéro '.$dernierProduit.'</h4>';
										}
										catch (Exception $erreur) {
											die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
										}
									}
								}
								
								if ( isset($_GET['idEfface']) ) {
									$id = $_GET['idEfface'];
									try {
										
										$ajoutReq = $bdd->prepare('DELETE FROM boutiques WHERE id=:id');
										$ajoutReq->execute( array(
												'id' => $id,
										));
										$derniereBoutique = $bdd->lastInsertId();
										echo '<h4>Cet Boutique a bien été effacé</h4>';
									}
									catch (Exception $erreur) {
										die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
									}
								}
								

							?>
							<?php
								if ( isset($_GET['idModif']) ){
									$idModif = $_GET['idModif'];
									try {
										
										$reponseReq = $bdd->prepare('SELECT * FROM boutiques WHERE id = :id');
										$reponseReq->execute( array(
												'id' => $idModif
										));
										$donnees = $reponseReq->fetch();
						?>			
							MODIFIER LES BOUTIQUES !
											<form action="admin.php" method="post" name="modifier" id="modifier" enctype="multipart/form-data">
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
												Image : <input type="file" id="image" name="image" />
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
			<?php 
				if ( isset($_POST['modifier']) ) {
								if ( isset($_POST['nom']) && isset($_POST['rue'])  && isset($_POST['cp']) && isset($_POST['ville']) && isset($_FILES['image']) ) {
										$idModif = $_POST['hdnIdboutique'];
										$nom = $_POST['nom'];
										$rue = $_POST['rue'];
										$cp = $_POST['cp'];
										$ville = $_POST['ville'];
										$image = $_FILES['image']['name'];
										echo $idModif." - ". $nom." - ". $image;
										try {
											$ajoutReq = $bdd->prepare('UPDATE boutiques SET nom = :nom, rue = :rue, cp = :cp, ville = :ville, image = :image WHERE id = :id');
											$ajoutReq->execute( array(
											'nom' => $nom,
											'rue' => $rue,
											'cp' => $cp,
											'ville' => $ville,
											'image' => $image,
											'id' => $idModif
											));
											echo '<h4>Cet Boutique a bien été modifié</h4>';
										}
											catch (Exception $erreur) {
													die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
											}
								}
				}
				if ( isset($_POST['créerC']) ) {
					if ( isset($_POST['nom'])) {
						$nom = $_POST['nom'];

						try {
								
							$ajoutReq = $bdd->prepare('INSERT INTO categorie VALUES (\'\', :nom)');
							$ajoutReq->execute( array(
									'nom' => $nom

							));
							$derniereCate = $bdd->lastInsertId();
							echo '<h4>Votre nouvelle a bien été enregistré sous le numéro '.$derniereCate.'</h4>';
						}
						catch (Exception $erreur) {
							die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
						}
					}
				}
			?>
			
							
							
								
						
						
						
									
									
							<br/><br/>
							
							</div>
							
						</div>
						</body>
</html>