<?php
include_once '../../../controllers/categorieController.php';
include_once '../../../models/categorie.php';

$error = "";
$categorie = null;
$categorieController = new CategorieController();

if (isset($_POST["submit"])) {
    if (!empty($_POST["nomcategorie"])) {
        // Récupérer les données du formulaire
        $nomcategorie = $_POST["nomcategorie"];
        $idcategorie = $_GET["idcategorie"];

        // Récupérer l'image actuelle de la catégorie depuis la base de données
        $categorieActuelle = $categorieController->getCategoryById($idcategorie);

        if ($categorieActuelle) {
            $imgcatgActuelle = $categorieActuelle['imgcatg'];

            // Récupérer le fichier image téléchargé
            $imgcatg = $_FILES["imgcatg"];

            // Si un nouveau fichier image a été téléchargé, procédez comme précédemment
            if (!empty($imgcatg["name"])) {
                $targetDirectory = "../../../images/";
                $targetFile = $targetDirectory . basename($imgcatg["name"]);

                // Déplacez le fichier téléchargé vers le dossier d'images
                if (move_uploaded_file($imgcatg["tmp_name"], $targetFile)) {
                    $imgcatgActuelle = $targetFile; // Utilisez le nouveau chemin
                } else {
                    // Gestion des erreurs de téléchargement
                    $error = "Erreur lors du téléchargement de l'image.";
                }
            }

            // Modifier la catégorie avec ou sans image
            $categorie = new Categorie($nomcategorie, $imgcatgActuelle);
            $categorieController->modifierCategorie($categorie, $idcategorie);

            // Rediriger vers une page de confirmation ou autre
            header('Location: showCategorie.php');
        } else {
            $error = "La catégorie n'a pas été trouvée.";
        }
    } else {
        $error = "Missing information";
    }
}

// Récupérer les informations de la catégorie à partir de la base de données
$idcategorie = $_GET["idcategorie"];
$categorie = $categorieController->getCategoryById($idcategorie);
?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <h1 class="text-3xl font-bold underline">
   Modification de catégorie
  </h1>
  <?php if ($categorie): ?>
  <form method="post" enctype="multipart/form-data">
    <div>
        <label for="nomcategorie">Nom de la catégorie :</label>
        <input type="text" id="nomcategorie" name="nomcategorie" value="<?php echo $categorie['nomcategorie']; ?>">
    </div>
    <div>
        <label for="imgcatg">Image de la catégorie :</label>
        <input type="file" id="imgcatg" name="imgcatg">
    </div>
    <div>
        <input type="submit" name="submit" value="Modifier la catégorie">
    </div>
  </form>
  <?php else: ?>
  <p><?php echo $error; ?></p>
  <?php endif; ?>
</body>
</html>
