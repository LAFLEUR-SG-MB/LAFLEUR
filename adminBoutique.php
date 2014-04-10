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
								Bienvenue adminBoutique, vous pourrez ici modifier vos boutiques.
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
							<form method ="post" action="admin.php" id="modifBoutique" >
									<p> 
									<i>Ici vous pourrez modifier vos boutiques.</i><br/>
									<u>Modifier vos adresses de boutiques.</U>
									<input type="radio" name="modif" value="adr" /> Les adresses
									<input type="submit" name="envoie" value="Valider"/>
						
							</form>
							<i>Ici vous pourrez ajouter vos administrateurs de boutiques.</i><br/>
							<form method="post" action="adminBoutique.php" id="ajoutAB">
								loginUtilisateur:<input type="text" name="loginUtilisateur"/><br/>
								mdpUtilisateur:<input type="text" name="mdpUtilisateur"/><br/>
								statusUtilisateur:<input type="radio" name="status">AdminBoutique</input>
								</select>
								<input type="reset" name="effacer" />	
								<input type="submit" name="créerA" />
							</form><br/><br/>
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
								if ( isset($_POST['créerA']) ) {
									if ( isset($_POST['loginUtilisateur']) && isset($_POST['mdpUtilisateur']) && isset($_POST['statusUtilisateur'])) {
										$loginUtilisateur = $_POST['loginUtilisateur'];
										$mdpUtilisateur = $_POST['mdpUtilisateur'];
										$statusUtilisateur = $_POST['statusUtilisateur'];
										try {
												
											$ajoutReq = $bdd->prepare('INSERT INTO administration VALUES (\'\', :loginUtilisateur, MD5(:mdpUtilisateur), :statusUtilisateur)');
											$ajoutReq->execute( array(
													'loginUtilisateur' => $loginUtilisateur,
													'mdpUtilisateur' => $mdpUtilisateur,
													'statusUtilisateur' => $statusUtilisateur
											));
										$nbLigne = $ajoutReq->rowCount();
										echo'Votre nouvel administrateur de boutique à été créer sous.'.$nbLigne;
				
										}
										catch (Exception $erreur) {
											die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
										}
									}
								}
								
							?>
							<?php
								try {
									$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
									$bdd = new PDO('mysql:host='.$ServeurBDD.';dbname='.$nomBDD, $utilBDD, $mdpUtilBDD);
									$reponseReq = $bdd->query('SELECT * FROM administration');
									echo '<table>';
									echo '<tr><td>Login</td><td>Mot de passe</td><td>Status</td>';
									echo '</tr>';
									while ( $donnees = $reponseReq->fetch() ){
										echo '<tr>';
										echo '<td>'.$donnees['loginUtilisateur'].'</td>';
										echo '<td>'.$donnees['mdpUtilisateur'].'</td>';
										echo '<td>'.$donnees['statusUtilisateur'].'</td>';
										echo '</tr>';
									}
									echo '</table>';
								}
								catch (Exception $erreur) {
									die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
								}
								
						?>
							<br/><br/>
							
							</div>
							
						</div>
						</body>
</html>
