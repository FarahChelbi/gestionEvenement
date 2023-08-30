<?php
require_once("C:\\xampp\\htdocs\\piDev2A\\controllers\\UtilisateurController.php");
include_once '../../../controllers/utilisateurController.php';

include_once '../../../models/utilisateur.php';
$message = "";

// Vérifier si le formulaire "Sign Up" a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    // Récupérer les données du formulaire
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $age = $_POST["age"];
    $role = $_POST["role"];
    $email = $_POST["email"];
    $mdp = $_POST["mdp"];

    $utilisateurController = new UtilisateurController();

    // Vérifier si l'email est unique avant d'ajouter l'utilisateur
    if ($utilisateurController->emailEstUnique($email)) {
        // Créer un nouvel utilisateur
        $user = new Utilisateur($nom, $prenom, $email, $age, $role, $mdp);
        
        // Appeler la fonction d'ajout d'utilisateur
        //$utilisateurController->ajouterUtilisateur($user);
        $utilisateurController->inscriptionUtilisateur($nom, $prenom, $email, $age, $role, $mdp);
        // Afficher un message de succès
        $message = "Inscription réussie. Vous pouvez maintenant vous connecter.";
    } else {
        // Afficher un message d'erreur si l'email existe déjà
        $message = "L'email existe déjà. Veuillez utiliser un autre email.";
    }
}

// Initialiser les variables
$email = "";
$mdp = "";

$msg="";
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST["email"];
    $mdp = $_POST["mdp"];

    $utilisateurController = new UtilisateurController();
   
    // Appeler la fonction connexionUtilisateur pour vérifier l'authentification
    $msg = $utilisateurController->connexionUtilisateur($email, $mdp);
    if (strpos($msg, "Connexion réussie en tant qu'utilisateur") !== false) {
        // Rediriger vers la page page.php après une connexion réussie
        header("Location: home.php");
        exit; // Arrêter l'exécution du script après la redirection
    }
// Afficher le formulaire de connexion

}
?>



<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Sign up / Login Form</title>
  <link rel="stylesheet" href="../assets/login/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	<!--<link rel="stylesheet" type="text/css" href="slide navbar style.css">-->
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<style>
        /* Appliquer des styles à la div principale */
        .main {
            width: 400px; /* Largeur de la div principale */
            height: 650px; /* Hauteur de la div principale */
            
        }
    
        label[for="chk"] {
    margin-bottom: -10px; /* Ajustez la valeur négative selon vos besoins */
}
        /* ... Autres styles pour les éléments internes ... */
    </style>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form action="loginFront.php" method="post">
					<label for="chk" aria-hidden="true">Sign up</label>
                    <input type="text" name="prenom" placeholder="First Name" required="">
					<input type="text" name="nom" placeholder="Last Name" required="">
					<input type="number" name="age" placeholder="Age" required="">
					<input type="text" name="role" placeholder="User Role" required="">
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="mdp" placeholder="Password" required="">
					<button type="submit" name="signup">Sign up</button>
				</form>
                <?php if (!empty($message)) { ?>
        <div class="error-message">
            <?php echo $message; ?>
        </div>
    <?php } ?>
			</div>

			<div class="login">
				<form action="loginFront.php" method="post">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="email" id="email" placeholder="Email" required="" autocomplete="email">
					<input type="password" name="mdp" id="mdp" placeholder="Password" required="" autocomplete="current-password">
					<button type="submit" name="login">Login</button>
				</form>
                <?php if (!empty($msg)) { ?>
        <div class="error-message">
            <?php echo $msg; ?>
        </div>
    <?php } ?>
			</div>
	</div>

 






</body>
</html>
<!-- partial -->
  
</body>
</html>
