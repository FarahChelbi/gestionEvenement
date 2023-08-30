<?php
include_once '../../../controllers/evenementController.php';
include_once '../../../models/evenement.php';

$error="";

$evenementController = new EvenementController();
//$eventListe = $evenementController->afficherEvenement();
$eventListe = $evenementController->afficherEvenementAvecCategoriesEtImages();
?>


<!DOCTYPE HTML>
<!--
	Solid State by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Generic - Solid State by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
	</head>

    <style>
        #header {
  
    padding: 10px 0; /* Espacement interne dans l'en-tête */
}

#header h1 {
    margin: 0; /* Supprime la marge autour du titre */
}

nav ul {
    list-style: none; /* Supprime les puces de la liste du menu */
    padding: 0; /* Supprime le remplissage de la liste du menu */
    margin: 0; /* Supprime la marge de la liste du menu */
}

nav li {
    display: inline-block; /* Affiche les éléments du menu horizontalement */
    margin-right: 20px; /* Espacement entre les éléments du menu */
}

nav a {
    color: #fff; /* Couleur du texte dans le menu */
    text-decoration: none; /* Supprime les soulignements sur les liens */
}

/* Style pour les liens au survol */
nav a:hover {
    text-decoration: underline;
}
.event-article {
    width: 300px; /* Largeur de la section */
    height: 200px; /* Hauteur de la section */
    
}
article p {
    margin-top: -15px; /* Réduisez la marge supérieure selon vos préférences */
}

    </style>
	<body class="is-preload">

		<!-- Page Wrapper -->
			<div id="page-wrapper">

			
<header id="header">
    <h1><a href="#"></a></h1>
    <nav>
        <ul class="links">
            <li><a href="home.php">Home</a></li>
            <li><a href="listEvents.php">Events</a></li>
            <li><a href="loginFront.php">Log Out</a></li>
            
        </ul>
    </nav>
</header>


				<!-- Wrapper -->
					<section id="wrapper">
						<header>
							<div class="inner">
								<h2>List of events</h2>
								<p>Check for the newest events</p>
							</div>
						</header>

						<!-- Content -->
							<div class="wrapper">
								<div class="inner">

									<h3 class="major">Events</h3>
									<p>You can browse here to see all of the available events</p>

									<section class="features" class="event-article">
                                       
                                        <?php foreach ($eventListe as $event) : ?>
                                        <article >
                                            <a href="#" class="image"><img src="<?= $event['imgcatg']; ?>" alt="<?= $event['nomcategorie']; ?>" width="40px" height="150px" /></a>
                                            <h3 class="major"><?= $event['titre']; ?></h3>
                                            <p>Date: <?= $event['dateevent']; ?></p>
                                            <p>Organisateur: <?= $event['organisateur']; ?></p>
                                            <p>Description: <?= $event['description']; ?></p>
                                            <p>Catégorie: <?= $event['nomcategorie']; ?></p>
                                           
                                        </article>
                                    <?php endforeach; ?>
									</section>

								</div>
							</div>

					</section>

				<!-- Footer -->
					<section id="footer">
						<div class="inner">
							<h2 class="major">Get in touch</h2>
							<p>Cras mattis ante fermentum, malesuada neque vitae, eleifend erat. Phasellus non pulvinar erat. Fusce tincidunt, nisl eget mattis egestas, purus ipsum consequat orci, sit amet lobortis lorem lacus in tellus. Sed ac elementum arcu. Quisque placerat auctor laoreet.</p>
							<form method="post" action="#">
								<div class="fields">
									<div class="field">
										<label for="name">Name</label>
										<input type="text" name="name" id="name" />
									</div>
									<div class="field">
										<label for="email">Email</label>
										<input type="email" name="email" id="email" />
									</div>
									<div class="field">
										<label for="message">Message</label>
										<textarea name="message" id="message" rows="4"></textarea>
									</div>
								</div>
								<ul class="actions">
									<li><input type="submit" value="Send Message" /></li>
								</ul>
							</form>
							<ul class="contact">
								<li class="icon solid fa-home">
									Untitled Inc<br />
									1234 Somewhere Road Suite #2894<br />
									Nashville, TN 00000-0000
								</li>
								<li class="icon solid fa-phone">(000) 000-0000</li>
								<li class="icon solid fa-envelope"><a href="#">information@untitled.tld</a></li>
								<li class="icon brands fa-twitter"><a href="#">twitter.com/untitled-tld</a></li>
								<li class="icon brands fa-facebook-f"><a href="#">facebook.com/untitled-tld</a></li>
								<li class="icon brands fa-instagram"><a href="#">instagram.com/untitled-tld</a></li>
							</ul>
							<ul class="copyright">
								<li>&copy; Untitled Inc. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
							</ul>
						</div>
					</section>

			</div>

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/jquery.scrollex.min.js"></script>
			<script src="../assets/js/browser.min.js"></script>
			<script src="../assets/js/breakpoints.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>

	</body>
</html>