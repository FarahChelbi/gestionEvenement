<?php
require_once("C:\\xampp\\htdocs\\piDev2A\\controllers\\UtilisateurController.php");

// Initialiser les variables
$nom = "";
$mdp = "";
$message = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $email = $_POST["email"]; // Changer $nom en $email
    $mdp = $_POST["mdp"];

    // Créer une instance du contrôleur utilisateur
    $utilisateurController = new UtilisateurController();

    // Appeler la fonction de connexionAdmin pour vérifier l'authentification
    $message = $utilisateurController->connexionAdmin($email, $mdp); // Changer $nom en $email

    // Si l'authentification est réussie en tant qu'administrateur, rediriger vers showUser.php
    if (strpos($message, "Connexion réussie en tant qu'administrateur") !== false) {
        header("Location: dashboard.php");
        exit; // Arrêter l'exécution du script après la redirection
    }
}

?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login Admin</title>
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'><link rel="stylesheet" href="../assets/login/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
	<div class="screen">
		<div class="screen__content">
			<form action="login.php" method="post" class="login">
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="email" name="email" id="email" class="login__input" placeholder="Email">
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" name="mdp" id="mdp" class="login__input" placeholder="Password">
				</div>
				<button class="button login__submit">
					<span class="button__text">Log In Now</span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>				
			</form>

            <?php if (!empty($message)) { ?>
        <div class="error-message">
            <?php echo $message; ?>
        </div>
    <?php } ?>
            <!--
			<div class="social-login">
				<h3>log in via</h3>
				<div class="social-icons">
					<a href="#" class="social-login__icon fab fa-instagram"></a>
					<a href="#" class="social-login__icon fab fa-facebook"></a>
					<a href="#" class="social-login__icon fab fa-twitter"></a>
				</div>
			</div>-->
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>
<!-- partial -->
  
</body>
</html>
