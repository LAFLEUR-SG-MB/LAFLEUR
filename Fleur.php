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
									 	<a href="Fleur.php"> <div class="lien"> Nos Fleurs </div></a>
									 	<br/><br/>
									 	<a href="plantes.php"> <div class="lien"> Nos Plantes </div></a>
									 	<br/><br/>
									 	<a href="compositions.php"> <div class="lien"> Compositions </div></a>
									 <br/><br/>
									  <a href="nosboutiques.php"> <div class="lien"> Nos Adresses </div></a>
									 
										
							</div>
							
							
							<div class="corpdusite">
										
			
			<?php
			include 'identifiants.php';
			try {
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				$bdd = new PDO('mysql:host='.$ServeurBDD.';dbname='.$nomBDD, $utilBDD, $mdpUtilBDD);
				$reponseReq = $bdd->query('SELECT * FROM produits WHERE categorie="fleurs" ');
				echo '<table>';
				echo '<tr><th class="tableau">produit_id</th><th class="tableau">nom</th><th class="tableau">sous_titre</th><th class="tableau">prix</th>';
				echo '<th class="tableau">image</th></tr>';
				while ( $donnees = $reponseReq->fetch() ){
					echo '<tr>';

					echo '<td class="tableau">'.$donnees['produit_id'].'</td>';
					echo '<td class="tableau">'.$donnees['nom'].'</td>';
					echo '<td class="tableau">'.$donnees['sous_titre'].'</td>';

					echo '<td class="tableau">'.$donnees['prix'].'</td>';
					echo '<td class="tableau"><img style="width:100px" src="images/fleurs/'.$donnees['image'].'"/></td>';
					echo '</tr>';
				}
				echo '</table>';
			}
			catch (Exception $erreur) {
				die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
			}
			
			
			?>
								
								
							</div>
							
						</div>
						</body>
</html>