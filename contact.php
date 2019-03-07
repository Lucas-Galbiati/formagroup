<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Forma'Group</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/base.css">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/body.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
</head>
<body>
  
<div class="header">
       
	<div class="header__texture"></div>
	
	<div class="header__mask">
		<svg width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="none">
			<path d="M0 100 L 0 0 C 25 100 75 100 100 0 L 100 100" fill="#fff"></path>
		</svg>
	</div>
	
	<div class="container">
        
		<div class="header__navbar">
			<div class="header__navbar--logo">
				
				
				
			</div>
			<div class="header__navbar--menu">
				<a href="index.php" class="header__navbar--menu-link"style="font-size: 35px;"><i class="fas fa-home"style="font-size: 35px;"></i>Acceuil</a>
				
				
			</div>
		</div>
		<div class="header__slogan">
			<h1 class="header__navbar--logo-title" style="margin-top: -50px; font-size: 70px;">FORMA'GROUP</h1>
				
			<h1 class="h__slogan--title">CREATEUR DE COMPETENCES</h1>
			
		</div>
	</div>
</div> 




<div class="body">

	<h1>Contact</h1>
    <form action="" method="post" style="position:absolute;
	left: 50%;
	
	width: 200px;
	height: 200px;
	margin-left: -100px; /* Cette valeur doit être la moitié négative de la valeur du width */
	">
    	<input type="text" name="pseudo_exp"/> Pseudo expéditeur<br>
    	<input type="email" name="email_exp"/> Email expéditeur<br>
    	<input type="text" name="objet"/>Objet<br>
    	Message	:<br>
    	<textarea name='message' cols='50' rows='4'></textarea><br>
    	<input type="submit" value="Envoyer">
    </form>

	
</div>

<?php
	if(isset($_POST)&& !empty($_POST['pseudo_exp']) &&!empty($_POST['objet'])
	&& !empty($_POST['message'])){
		extract($_POST);
		$destinataire='stephane.rolland@formagroup.fr';
		$expediteur=$pseudo_exp.' <' .$email_exp.'>';
		$mail=mail($destinataire,$objet,$message,$expediteur.' : Patrimgest.com : Mail de test');
   		if($mail) echo 'Email envoyé avec succés !!';
   		else echo'Echec envoi ';
  		}


?>

	

</body>
</html>
