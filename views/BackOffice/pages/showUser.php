<?php

include_once '../../../controllers/utilisateurController.php';
include_once '../../../models/utilisateur.php';

$error = "";

$utilisateurController = new UtilisateurController();
$utilisateurListe = $utilisateurController->afficherUtilisateur();

?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
</head>
<body>
  <h1 class="text-3xl font-bold underline">
    Liste des utilisateurs
  </h1>
  <table border="1px">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Email</th>
            <th>Age</th>
            <th>Role</th>
            <th>Modifier</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($utilisateurListe as $utilisateur): ?>
        <tr>
            <td>
                <h5> <?php echo $utilisateur['id']; ?> </h5>
            </td>
            <td>
                <h5> <?php echo $utilisateur['nom']; ?> </h5>
            </td>
            <td>
                <h5> <?php echo $utilisateur['prenom']; ?> </h5>
            </td>
            <td>
                <h5> <?php echo $utilisateur['email'] ;?> </h5>
            </td>
            <td>
                <h5> <?php echo $utilisateur['age'] ;?> </h5>
            </td>
            <td>
                <h5> <?php echo $utilisateur['role'] ;?> </h5>
            </td>
            <td>
               <a href="oneUser.php?id=<?php echo $utilisateur['id']; ?>">Afficher le produit </a>
               <a href="editUser.php?id=<?php echo $utilisateur['id']; ?>">Modifier utilisateur </a>
               <a href="deleteUser.php?id=<?php echo $utilisateur['id']; ?>">Supprimer utilisateur </a>
            </td>
            <td>
           
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
  <form action="addUser.php">
        <input type="submit" value="Aller vers la page 2">
    </form>
  

</body>
</html>