<?php
include_once '../../../controllers/utilisateurController.php';
include_once '../../../models/utilisateur.php';
// Vérifier si la requête POST contient une valeur de recherche
if (isset($_POST['search'])) {
    $searchValue = $_POST['search'];

    // Utiliser la classe UtilisateurController pour effectuer la recherche
    $utilisateurController = new UtilisateurController();
    $searchResults = $utilisateurController->searchUser($searchValue);

    // Renvoyer les résultats au format JSON
    echo json_encode($searchResults);
} else {
    // Gérer les cas où aucune valeur de recherche n'est fournie
    echo json_encode([]);
}
?>
