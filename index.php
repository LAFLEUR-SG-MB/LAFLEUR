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
									 <?php session_start(); if ($_SESSION['statutUtilisateur'] != "U"){echo'<a href="admin.php"> <div class="lien"> Admin </div></a>'; }?>
									  <br/><br/>	

							</div>
							
							
							<div class="corpdusite">
							<br/>
									<img src="images/lafleur.gif" />
									<h1>
									Dites-le avec des fleurs !
									</h1>
									
									
							<br/><br/>
							<form method ="post" action="index.php" id="connexion" >
									<p> 
									<fieldset>
									Login : <input type="text" name="login"/><br/>
									Password : <input type="text" name="mdp" />
									<br/>
									<input type="reset" name="effacer" />	
									<input type="submit" name="connexion" />	
									</fieldset>
							</form>
							<?php 
							$_SESSION['statutUtilisateur'] = "U";
								if (isset($_POST['login']) && isset($_POST['mdp']))
								{
									$login = $_POST['login'];
									$mdp = $_POST['mdp'];
										try {
											$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
											$bdd = new PDO('mysql:host='.$ServeurBDD.';dbname='.$nomBDD, $utilBDD, $mdpUtilBDD);
											$ajoutReq = $bdd->prepare('SELECT * FROM administration WHERE loginUtilisateur= :login AND mdpUtilisateur = MD5(:mdp)');
											$ajoutReq->execute( array(
					
													'login' => $login,
													'mdp' => $mdp,
					
											));
											$ligne = $ajoutReq->rowCount();
											$donnees = $ajoutReq->fetch();
											if ($ligne >= 1){
												echo 'Vous êtes bien connectés.
													<br/>';
				
												$_SESSION['loginUtilisateur'] = $login;
												$_SESSION['statutUtilisateur'] = $donnees['statusUtilisateur'];
												if ($_SESSION['statutUtilisateur'] == "AG"){
													header('location: adminGeneral.php');		
													exit();
												}
												else if($_SESSION['statutUtilisateur'] == "AB"){
													header('location: adminBoutique.php');
													exit();
												}
												else{
												/*	header('location: index.php');
													exit();*/
												}
											}
											else{
												echo 'Erreur';
											}
										}
										catch (Exception $erreur)
										{
											die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
										}
									
								}
						?>
							</div>
							
						</div>
						</body>
</html>