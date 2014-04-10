
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

									 	<br/><br/>
									 	<a href="compositions.php"> <div class="lien"> Produits </div></a>
									 <br/><br/>
									  <a href="nosboutiques.php"> <div class="lien"> Nos Adresses </div></a>
									  	 <br/><br/>
									  <a href="admin.php"> <div class="lien"> Admin </div></a>


							</div>
				
				
							<div class="corpdusite">

					<?php
									include 'secret/identifiants.php';
							?>

							<div class="corpdusite">
									<br/>
									<?php
										if(isset($_GET['id']))	{
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
}
?>
				
							</div>
							
						</div>
						</body>
</html>