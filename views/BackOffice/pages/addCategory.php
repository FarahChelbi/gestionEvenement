<?php
include_once '../../../controllers/categorieController.php';
include_once '../../../models/categorie.php';

$error = "";
$categorie = null;

$categorieController = new CategorieController();

if(
    isset($_POST["submit"]) 
){
    if(
        !empty($_POST["nomcategorie"]) 
    ){
        $categorie = new Categorie(
            $_POST['nomcategorie'],
            $_POST['imgcatg'],
        );
        $categorieController->ajouterCategorie($categorie);
        header('Location:showCategorie.php');
    }else{
        $error = "Missing information";
    }
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
    <form action="addCategory.php" method="post">
        <div>
            <label for="nomcategorie">Nom categorie :</label>
            <input type="text" name="nomcategorie" id="nomcategorie" required>
        </div>
        <div>
            <label for="imgcatg">Image :</label>
            <input type="text" name="imgcatg" id="imgcatg" >
        </div>
        
        <div>
            <button type="submit" name="submit">Ajouter la categorie</button>
        </div>
        
    </form>
</body>

</html>