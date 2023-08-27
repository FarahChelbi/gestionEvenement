<?php
include_once '../../../controllers/evenementController.php';
include_once '../../../models/evenement.php';

$error = "";
$event = null;
$evenementController = new EvenementController();

if(
    isset($_POST["submit"]) 
){
    if(
        !empty($_POST["titre"]) &&
        !empty($_POST["dateevent"]) &&
        !empty($_POST["organisateur"])
    ){
        $event = new Evenement(
            $_POST['titre'],
            $_POST['dateevent'],
            $_POST['organisateur'],
            $_POST['description'],
        );
        $evenementController->ajouterEvenement($event);
        header('Location:addEvent.php');
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
    <title>Ajouter un evenement</title>
</head>

<body>
    <h1>Ajouter un evenement</h1>
    <form action="addEvent.php" method="post">
        <div>
            <label for="titre">Titre :</label>
            <input type="text" name="titre" id="titre" required>
        </div>
        <div>
            <label for="dateevent">Date :</label>
            <input type="date" name="dateevent" id="dateevent" >
        </div>
        
        <div>
            <label for="organisateur">Organisateur :</label>
            <input type="text" name="organisateur" id="organisateur" >
        </div>
        <div>
            <label for="description">Description :</label>
            <input type="text" name="description" id="description" >
        </div>
        <div>
            <button type="submit" name="submit">Ajouter l'evenement</button>
        </div>
        
    </form>
</body>

</html>