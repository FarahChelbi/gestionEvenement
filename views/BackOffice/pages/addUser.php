<?php
include_once '../../../controllers/utilisateurController.php';
include_once '../../../models/utilisateur.php';

$error = "";
$utilisateur = null;

$utilisateurController = new UtilisateurController();
$rolesAutorises = ["admin", "organisateur", "participant"];
if (
    isset($_POST["submit"]) 
) {
    if(
        !empty($_POST["nom"]) && 
        !empty($_POST["prenom"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["age"]) &&
        !empty($_POST["role"])&&
        !empty($_POST["mdp"])
        ){
            if (in_array($_POST["role"], $rolesAutorises)) {
            $utilisateur = new Utilisateur(
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['email'],
                intval($_POST['age']),
                $_POST['role'],
                //password_hash ($_POST ['mdp'] , PASSWORD_DEFAULT)
                $_POST['mdp'],
            );
            $utilisateurController->ajouterUtilisateur($utilisateur);
            header('Location:showUser.php');
        }else {
            $error = "Rôle non autorisé.";
        }

        }
        else{
            $error = "Missing information";
        }
    
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur</title>
</head>
<body>
    <h1>Ajouter un utilisateur</h1>
  
    <form action="addUser.php" method="post">
        <div>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required>
        </div>
        <div>
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" required>
        </div>
        <div>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="age">Âge :</label>
            <input type="number" name="age" id="age" required>
        </div>
        <div>
            <label for="role">Rôle :</label>
            <input type="text" name="role" id="role" required>
        </div>
        <div>
            <label for="mdp">Mot de passe :</label>
            <input type="password" name="mdp" id="mdp" required>
        </div>
        <div>
            <button type="submit" name="submit">Ajouter l'utilisateur</button>
        </div>
        
    </form>

    <!-- Affichage du message d'erreur -->
  <?php if (!empty($error)) { ?>
        <div class="error-message">
            <?php echo $error; ?>
        </div>
    <?php } ?>
</body>
</html>
