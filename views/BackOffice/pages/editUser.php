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
                $_POST['mdp'],
            );
            $utilisateurController->modifierUtilisateur($utilisateur,$_GET["id"]);
            header('Location:showUser.php');
        }
        else {
            $error = "Rôle non autorisé. Changez SVP!!!";
        }

    }}
?>


    <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un utilisateur</title>
</head>
<body>
    <h1>Modifier un utilisateur</h1>
    <div>
    <?php
    if (isset($_GET['id'])) {
        $utilisateur = $utilisateurController->getUserById($_GET['id'])

    ?>
    <form action="editUser.php?id=<?php echo $_GET['id']; ?>" method="post">
        <div>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" value="<?php echo $utilisateur['nom'] ?>" required>
        </div>
        <div>
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" value="<?php echo $utilisateur['prenom'] ?>" required>
        </div>
        <div>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" value="<?php echo $utilisateur['email'] ?>" required>
        </div>
        <div>
            <label for="age">Âge :</label>
            <input type="number" name="age" id="age" value="<?php echo $utilisateur['age'] ?>" required>
        </div>
        <div>
            <label for="role">Rôle :</label>
            <input type="text" name="role" id="role" value="<?php echo $utilisateur['role'] ?>" required>
        </div>
        <div>
            <label for="mdp">Mot de passe :</label>
            <input type="password" name="mdp" id="mdp" value="<?php echo $utilisateur['nom'] ?>" required>
        </div>
        <div>
            <button name="submit">submit</button>
        </div>
    </form>
    <?php } ?>

     <!-- Affichage du message d'erreur -->
     <?php if (!empty($error)) { ?>
            <div class="error-message">
                <?php echo $error; ?>
            </div>
        <?php } ?>
    
    </div>

    
</body>
</html>


