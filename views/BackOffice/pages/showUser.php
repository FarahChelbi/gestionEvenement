<?php

include_once '../../../controllers/utilisateurController.php';
include_once '../../../models/utilisateur.php';

$error = "";

$utilisateurController = new UtilisateurController();
$utilisateurListe = $utilisateurController->afficherUtilisateur();

$searchResults = [];

// Vérifier si un terme de recherche est spécifié dans l'URL
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];

    // Utiliser la méthode de recherche pour obtenir les résultats
    $searchResults = $utilisateurController->searchUser("%$searchTerm%");
}

?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
  
</head>
<body>

<h1 class="text-3xl font-bold underline">
        Liste des utilisateurs
    </h1>

    <!-- Champ de recherche avancée -->
    <div>
        <label for="search">Recherche avancée :</label>
        <input type="text" id="search" placeholder="Commencez à taper...">
    </div>

  <table border="1px">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Email</th>
            <th>Age</th>
            <th>Role</th>
            <th>Modifier</th>
        </tr>
    </thead>
    <tbody id="searchResults">
        <?php foreach($utilisateurListe as $utilisateur): ?>
        <tr>
            <td>
                <h5> <?php echo $utilisateur['id']; ?> </h5>
            </td>
            <td>
                <h5> <?php echo $utilisateur['nom']; ?> </h5>
            </td>
            <td>
                <h5> <?php echo $utilisateur['prenom']; ?> </h5>
            </td>
            <td>
                <h5> <?php echo $utilisateur['email'] ;?> </h5>
            </td>
            <td>
                <h5> <?php echo $utilisateur['age'] ;?> </h5>
            </td>
            <td>
                <h5> <?php echo $utilisateur['role'] ;?> </h5>
            </td>
            <td>
               <a href="oneUser.php?id=<?php echo $utilisateur['id']; ?>">Afficher le produit </a>
               <a href="editUser.php?id=<?php echo $utilisateur['id']; ?>">Modifier utilisateur </a>
               <a href="deleteUser.php?id=<?php echo $utilisateur['id']; ?>">Supprimer utilisateur </a>
            </td>
            <td>
           
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
  </table>

  <script>
    // Lorsque l'utilisateur tape dans le champ de recherche
    $("#search").on("input", function() {
        // Récupérer la valeur du champ de recherche
        var searchValue = $(this).val();

        // Effectuer une requête AJAX vers le serveur
        $.ajax({
            url: "searchUser.php",
            method: "POST",
            data: { search: searchValue },
            dataType: "json",
            success: function(data) {
                // Mettre à jour la liste des utilisateurs avec les résultats
                var searchResults = $("#searchResults"); // Utiliser l'id que vous avez ajouté
                searchResults.empty(); // Effacer la liste actuelle

                $.each(data, function(index, utilisateur) {
                    // Créer une nouvelle ligne pour chaque utilisateur
                    var row = "<tr>";
                    row += "<td>" + utilisateur.id + "</td>";
                    row += "<td>" + utilisateur.nom + "</td>";
                    row += "<td>" + utilisateur.prenom + "</td>";
                    row += "<td>" + utilisateur.email + "</td>";
                    row += "<td>" + utilisateur.age + "</td>";
                    row += "<td>" + utilisateur.role + "</td>";
                    row += "<td><a href='editUser.php?id=" + utilisateur.id + "'>Modifier</a></td>";
                    row += "</tr>";
                    searchResults.append(row);
                });
            }
        });
    });
</script>


  <form action="addUser.php">
        <input type="submit" value="Aller vers la page 2">
    </form>
  

</body>
</html>