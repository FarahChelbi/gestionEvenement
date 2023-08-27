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
        $categorieController->modifierCategorie($categorie,$_GET["idcategorie"]);
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
    <title>Modifier une categorie</title>
</head>

<body>
    <h1>Modifier une categorie</h1>
    <?php
    if (isset($_GET['idcategorie'])) {
        $categorie = $categorieController->getCategoryById($_GET["idcategorie"]);

    ?>
    <form action="editCategory.php?idcategorie=<?php echo $_GET['idcategorie']; ?>" method="post">
        <div>
            <label for="nomcategorie">Nom categorie :</label>
            <input type="text" name="nomcategorie" id="nomcategorie" value="<?php echo $categorie['nomcategorie'] ?>" required>
        </div>
        <div>
            <label for="imgcatg">Image :</label>
            <input type="text" name="imgcatg" id="imgcatg" value="<?php echo $categorie['imgcatg'] ?>">
        </div>
        
        <div>
            <button type="submit" name="submit">Modifier la categorie</button>
        </div>
        
    </form>
    <?php } ?>
</body>

</html>