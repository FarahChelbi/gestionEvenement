<?php
include_once '../../../controllers/evenementController.php';
include_once '../../../models/evenement.php';

$error="";

$evenementController = new EvenementController();
$eventListe = $evenementController->afficherEvenement();
?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
</head>
<body>
  <h1 class="text-3xl font-bold underline">
    Liste des évènements
  </h1>
  <table border="1px">
    <thead>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Date</th>
            <th>Organisateur</th>
            <th>Description</th>
            
            <th>Modifier</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($eventListe as $event): ?>
        <tr>
            <td>
                <h5> <?php echo $event['idevent']; ?> </h5>
            </td>
            <td>
                <h5> <?php echo $event['titre']; ?> </h5>
            </td>
            <td>
                <h5> <?php echo $event['dateevent']; ?> </h5>
            </td>
            <td>
                <h5> <?php echo $event['organisateur'] ;?> </h5>
            </td>
            <td>
                <h5> <?php echo $event['description'] ;?> </h5>
            </td>
           
            <td>
               <a href="oneEvent.php?idevent=<?php echo $event['idevent']; ?>">Afficher l'évènement' </a>
               <a href="editEvent.php?idevent=<?php echo $event['idevent']; ?>">Modifier évènement </a>
               <a href="deleteEvent.php?idevent=<?php echo $event['idevent']; ?>">Supprimer évènement </a>
            </td>
            <td>
           
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
  <form action="addEvent.php">
        <input type="submit" value="Ajouter un nouveau evenement">
    </form>
  

</body>
</html>