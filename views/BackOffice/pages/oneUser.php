<?php

include_once '../../../models/utilisateur.php';
include_once '../../../controllers/utilisateurController.php';

$error = "";
$utilisateur = new UtilisateurController();

?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
</head>
<body>
  <h1>
   this user
  </h1>
  <div>
  <?php
    if (isset($_GET['id'])) {
        //$utilisateur = $utilisateurController->getUserById($_GET['id']);
        $utilisateur = $utilisateur->getUserById($_GET['id']);
    ?>
    <div>
        <h3>Nom: <?php echo $utilisateur['nom'] ?></h3>
        <h3>Prenom: <?php echo $utilisateur['prenom'] ?></h3>
    </div>
    <?php } ?>
  </div>
</body>
</html>
