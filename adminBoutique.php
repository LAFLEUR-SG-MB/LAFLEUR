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
							<?php
								try {
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
						<?php 
						/*				if(isset($_GET['id']))	{
												try {
													$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
													$bdd = new PDO('mysql:host='.$ServeurBDD.';dbname='.$nomBDD, $utilBDD, $mdpUtilBDD);
													$reponseReq = $bdd->query('SELECT * FROM boutiques WHERE id='.$_GET['id']);
													echo '<table class="tableauboutiques">';
													echo '<tr><th>NOM</th><th>RUE</th><th>CP</th><th>VILLE</th>';
													echo '<th>IMAGE</th></tr>';
													while ($donnees = $reponseReq->fetch()){
														echo '<tr>';
														echo '<td>'.$donnees['nom'].'</td>';
														echo '<td>'.$donnees['rue'].'</td>';
														echo '<td>'.$donnees['cp'].'</td>';
														echo '<td>'.$donnees['ville'].'</td>';
														echo '<td><img style="width:150px" src="image_s/boutiques/boutique_'.$donnees['ville'].'.jpg"/></td>';
														echo '</tr>';
													}
													echo '</table>';
													echo'</br></br>';
													$reponseReq2 = $bdd->query('SELECT telephone,horaires FROM boutiques WHERE id ='.$_GET['id']);
													echo'<table class="telhoraire">';
													echo '<tr><th>TELEPHONE</th><th>HORAIRES</th></tr></br>';
													while($donnees = $reponseReq2->fetch()){
														echo '<td>'.$donnees['telephone'].'</td>';
														echo '<td>'.$donnees['horaires'].'</td>';
													}
													echo'</tr>';
												}
												catch (Exception $erreur) {
													die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
												}
										}*/
	$reponseReq = $bdd->query('SELECT * FROM boutiques');
?>
						</form>
							<i>Ici vous pourrez ajouter vos administrateurs de boutiques.</i><br/>
							<form method="post" action="adminBoutique.php" id="ajoutAB">
								Login de l'Utilisateur:<input type="text" name="loginUtilisateur"/><br/>
								Mot de passe de l'Utilisateur:<input type="text" name="mdpUtilisateur"/><br/>
								Choississez votre boutique à administrer :
								<select name="ville" id="ville">
								<?php
								while ($donnees = $reponseReq->fetch()){?>
									<option value="<?php echo $donnees['id'];?>"><?php echo $donnees['nom']." - ".$donnees['ville'];?></option>
								<?php }?>
								</select><br/>
								<br/>
								<input type="reset" name="effacer" />	
								<input type="submit" name="créerA" />
							</form><br/><br/>
							<?php 
								if ( isset($_POST['créerA']) ) {
									if ( isset($_POST['loginUtilisateur']) && isset($_POST['mdpUtilisateur'])) {
										$loginUtilisateur = $_POST['loginUtilisateur'];
										$mdpUtilisateur = $_POST['mdpUtilisateur'];
										$villeUtilisateur = $_POST['ville'];
										try {
											
											$ajoutReq = $bdd->prepare('INSERT INTO administration VALUES (:login, MD5(:mdp), :status,:idBout)');
											$ajoutReq->execute( array(
													'login' => $loginUtilisateur,
													'mdp' => $mdpUtilisateur,
													'idBout' => $villeUtilisateur,
													'status' => 'AB'
											));
											echo '<h4>Votre nouvel Admin a bien été enregistré</h4>';
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
