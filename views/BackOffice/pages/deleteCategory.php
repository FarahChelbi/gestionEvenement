<?php
include '../../../controllers/categorieController.php';
$categorieController = new CategorieController();
$categorieController->supprimerCategorie($_GET["idcategorie"]);
header('Location:showCategory.php');
?>