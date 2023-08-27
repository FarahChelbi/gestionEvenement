<?php
require_once("C:\\xampp\\htdocs\\piDev2A\\controllers\\UtilisateurController.php");

// Initialiser les variables
$nom = "";
$mdp = "";
$message = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST["nom"];
    $mdp = $_POST["mdp"];

    // Créer une instance du contrôleur utilisateur
    $utilisateurController = new UtilisateurController();

    // Appeler la fonction de connexionAdmin pour vérifier l'authentification
    $message = $utilisateurController->connexionAdmin($nom, $mdp);

    // Si l'authentification est réussie en tant qu'administrateur, rediriger vers showUser.php
    if (strpos($message, "Connexion réussie en tant qu'administrateur") !== false) {
        header("Location: showUser.php");
        exit; // Arrêter l'exécution du script après la redirection
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Administrateur</title>
</head>
<body>
    <h1>Connexion Administrateur</h1>
    <form action="login.php" method="post">
        <div>
            <label for="nom">Nom d'utilisateur :</label>
            <input type="text" name="nom" id="nom" required>
        </div>
        <div>
            <label for="mdp">Mot de passe :</label>
            <input type="password" name="mdp" id="mdp" required>
        </div>
        <div>
            <button type="submit">Connexion</button>
        </div>
    </form>

    <!-- Afficher le message d'erreur -->
    <?php if (!empty($message)) { ?>
        <div class="error-message">
            <?php echo $message; ?>
        </div>
    <?php } ?>
</body>
</html>
