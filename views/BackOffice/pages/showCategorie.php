<?php
include_once '../../../controllers/categorieController.php';
include_once '../../../models/categorie.php';

$error = "";

$categorieController = new CategorieController();
$categorieListe = $categorieController->afficherCategorie();
?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
</head>
<body>
  <h1 class="text-3xl font-bold underline">
   Liste des catégories
  </h1>
  <table border="1px">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom categorie</th>
            <th>image</th>
            <th>Modifier</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($categorieListe as $categorie): ?>
        <tr>
            <td>
                <h5> <?php echo $categorie['idcategorie']; ?> </h5>
            </td>
            <td>
                <h5> <?php echo $categorie['nomcategorie']; ?> </h5>
            </td>
            <td style="text-align: center;">
            <img src="<?php echo $categorie['imgcatg']; ?>" alt="Image de la catégorie" width="100" height="100">
            </td>
            
            <td>
               
               <a href="editCategory.php?idcategorie=<?php echo $categorie['idcategorie']; ?>">Modifier la categorie </a>
               <a href="deleteCategory.php?idcategorie=<?php echo $categorie['idcategorie']; ?>">Supprimer utilisateur </a>
            </td>
            <td>
           
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
  <form action="addCategory.php">
        <input type="submit" value="Aller vers la page 2">
    </form>
  

</body>
</html>