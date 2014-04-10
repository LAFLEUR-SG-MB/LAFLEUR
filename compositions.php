<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">.

<title>compositions</title>
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
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			$bdd = new PDO('mysql:host='.$ServeurBDD.';dbname='.$nomBDD, $utilBDD, $mdpUtilBDD);

			
				try {

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
			include 'identifiants.php';
			if (isset($_GET['categorie'])){
				echo'<h2>Voici notre sélection </h2>';
			
				try {
					$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
					$bdd = new PDO('mysql:host='.$ServeurBDD.';dbname='.$nomBDD, $utilBDD, $mdpUtilBDD);
					$reponseReq = $bdd->query('SELECT * FROM produits WHERE categorie = "'.$_GET['categorie'].'"');
					echo '<table>';
					echo '<tr><th class="tableau">nom</th><th class="tableau">sous_titre</th><th class="tableau">prix</th>';
					echo '<th class="tableau">image</th></tr>';
					while ( $donnees = $reponseReq->fetch() ){
						echo '<tr>';
	

						echo '<td class="tableau">'.$donnees['nom'].'</td>';
						echo '<td class="tableau">'.$donnees['sous_titre'].'</td>';
	
						echo '<td class="tableau">'.$donnees['prix'].'</td>';
						echo '<td class="tableau"><img style="width:100px" src="image_s/produits/'.$donnees['image'].'"/></td>';

						echo '</tr>';
					}
					echo '</table>';
				}
				catch (Exception $erreur) {
					die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
				}
		
			}
		?>
								
								
							</div>
							
						</div>
						</body>
</html>