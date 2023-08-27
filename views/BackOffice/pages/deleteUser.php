<?php
include '../../../controllers/utilisateurController.php';
$utilisateurController = new UtilisateurController();
$utilisateurController->supprimerUtilisateur($_GET["id"]);
header('Location:showUser.php');
?>