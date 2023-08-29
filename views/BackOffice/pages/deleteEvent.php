<?php
include '../../../controllers/evenementController.php';
$evenementController = new EvenementController();
$evenementController->supprimerEvenement($_GET["idevent"]);
header('Location:showEvent.php');
?>