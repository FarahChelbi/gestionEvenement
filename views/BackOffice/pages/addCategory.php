

<?php
include_once '../../../controllers/categorieController.php';
include_once '../../../models/categorie.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nomcategorie = $_POST["nomcategorie"];

    // Récupérer le fichier image téléchargé
    $imgcatg = $_FILES["imgcatg"];

    // Créer une instance du contrôleur de catégorie
    $categorieController = new CategorieController();

    // Ajouter la catégorie avec l'image
    $categorie = new Categorie($nomcategorie, "");
    $categorie->setNomCategorie($nomcategorie);

    // Vérifier si un fichier a été téléchargé
    if (!empty($imgcatg["name"])) {
        $targetDirectory = "../../../images/";
 
        $targetFile = $targetDirectory . basename($imgcatg["name"]);

        // Déplacez le fichier téléchargé vers le dossier d'images
        if (move_uploaded_file($imgcatg["tmp_name"], $targetFile)) {
            $categorie->setImgCatg($targetFile);
        } else {
            // Gestion des erreurs de téléchargement
            echo "Erreur lors du téléchargement de l'image.";
            exit;
        }
    }

    // Ajouter la catégorie avec ou sans image
    $categorieController->ajouterCategorie($categorie);

    // Rediriger vers une page de confirmation ou autre
    header("Location: showCategorie.php");
    exit;
}


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une categorie</title>
</head>

<body>
    <h1>Ajouter un utilisateur</h1>
    <form action="addCategory.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="nomcategorie">Nom categorie :</label>
            <input type="text" name="nomcategorie" id="nomcategorie" required>
        </div>
        <div>
            <label for="imgcatg">Image :</label>
            <input type="file" name="imgcatg" id="imgcatg" >
        </div>
        
        <div>
            <button type="submit" name="submit">Ajouter la categorie</button>
        </div>
        
    </form>
</body>

</html>