<?php
include_once '../../../models/evenement.php';
include_once '../../../controllers/evenementController.php';

$error = "";
$event = new EvenementController();
?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
</head>
<body>
  <h1>
   this event
  </h1>
  <div>
  <?php
    if (isset($_GET['idevent'])) {
        //$utilisateur = $utilisateurController->getUserById($_GET['id']);
        $evenement = $event->getEventById($_GET['idevent'])
    ?>
    <div>
        <h3>Titre: <?php echo $evenement['titre'] ?></h3>
        <h3>Date: <?php echo $evenement['dateevent'] ?></h3>
    </div>
    <?php } ?>
  </div>
</body>
</html>
