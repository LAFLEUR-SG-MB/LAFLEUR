<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Fleurs</title>
<link rel="stylesheet" type="text/css" media="screen" href="css/cssfleur.css"/>
</head>
						<body background="img/fleurfond.jpg"><p>
					<div class="principal">
					
							<a href="index.php"><div class="titre" >
										<!-- image de 60px d'hauteur et 100 de largeur --> 
										<img class="gauche" src="img/logo.PNG" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; LAFLEUR

							</div></a>
							
<div class="colonegauche">
 <p> 
									 		<h2>Menu</h2></p>
									 		<br/>
									 		  <a href="nosboutiques.php"> <div class="lien"> Nos Adresses </div></a>
									 <br/><br/>
<?php
			include 'identifiants.php';
			

			
				try {
					$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
					$bdd = new PDO('mysql:host='.$ServeurBDD.';dbname='.$nomBDD, $utilBDD, $mdpUtilBDD);
					$reponseReq = $bdd->query('SELECT * FROM categorie ');

					while ( $donnees = $reponseReq->fetch() ){
						echo '<a href="compositions.php?categorie='.$donnees['numero_categorie'].'"> <div class="lien"> '.$donnees['nom_categorie'].' </div></a>
										 <br/><br/>';
	

					}
					echo '</table>';
				}
				catch (Exception $erreur) {
					die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
				}
		
			
		?>
									 <br/><br/>
									  <a href="admin.php"> <div class="lien"> Admin </div></a>
									  <br/><br/>


							</div>
							
							
							<div class="corpdusite">
										
			
		<?php 
									include 'secret/identifiants.php';
							?>
							
							<div class="corpdusite">
							
									<br/>
									<?php 
										try {
											$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
											$bdd = new PDO('mysql:host='.$ServeurBDD.';dbname='.$nomBDD, $utilBDD, $mdpUtilBDD);
											$reponseReq = $bdd->query('SELECT * FROM boutiques');
											
											
											while ( $donnees = $reponseReq->fetch() ){
												echo '<a href="boutique.php?id='.$donnees['id'].'"<p>'.$donnees['nom'].'</a><br/><br/>';
												
											}
											
										}
										catch (Exception $erreur) {
											die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
										}
										
										
									?>
								
								
							</div>
							
						</div>
						</body>
</html>