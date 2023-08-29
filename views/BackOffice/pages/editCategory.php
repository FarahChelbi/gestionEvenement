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
            header('Location: showCategory.php');
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
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="../assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Light Bootstrap Dashboard by Creative Tim</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="../assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="../assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text">
                    Admin
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="dashboard.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="active">
                    <a href="addUser.php">
                        <i class="pe-7s-user"></i>
                        <p>Add a new user</p>
                    </a>
                </li>
                <li>
                    <a href="showUser.php">
                        <i class="pe-7s-note2"></i>
                        <p>Users List</p>
                    </a>
                </li>
                <li>
                    <a href="addCategory.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Add new category</p>
                    </a>
                </li>
                <li>
                    <a href="showCategorie.php">
                        <i class="pe-7s-note2"></i>
                        <p>Categories List</p>
                    </a>
                </li>
                <li>
                    <a href="addEvent.php">
                        <i class="pe-7s-map-marker"></i>
                        <p>Add Event</p>
                    </a>
                </li>
                <li>
                    <a href="showEvent.php">
                        <i class="pe-7s-note2"></i>
                        <p>Events list</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">User</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
								<p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret hidden-sm hidden-xs"></b>
                                    <span class="notification hidden-sm hidden-xs">5</span>
									<p class="hidden-lg hidden-md">
										5 Notifications
										<b class="caret"></b>
									</p>
                              </a>
                              
                        </li>
                        <li>
                           <a href="">
                                <i class="fa fa-search"></i>
								<p class="hidden-lg hidden-md">Search</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="">
                               <p>Account</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
										Dropdown
										<b class="caret"></b>
									</p>

                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                              </ul>
                        </li>
                        <li>
                            <a href="login.php">
                                <p>Log out</p>
                            </a>
                        </li>
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Category</h4>
                            </div>
                            <div class="content">

                            <?php if ($categorie): ?>
     
    <form action="editCategory.php?idcategorie=<?php echo $_GET['idcategorie']; ?>" method="post" enctype="multipart/form-data">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nomcategorie">Name</label>
                    <input type="text" name="nomcategorie" id="nomcategorie" class="form-control" placeholder="Enter your First Name" value="<?php echo $categorie['nomcategorie'] ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="imgcatg">Image</label>
                    <input type="file" name="imgcatg" id="imgcatg" class="form-control" placeholder="Enter your Last Name" value="<?php echo $categorie['nom'] ?>">
                </div>
            </div>
        </div>


        <button type="submit" name="submit" class="btn btn-info btn-fill pull-right">Confirm</button>
        <div class="clearfix"></div>
    </form>
    <?php else: ?>
        <p><?php echo $error; ?></p>
  <?php endif; ?>
</div>

                        </div>
                    </div>
                    

                </div>
            </div>
        </div>


        

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="../assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="../assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="../assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="../assets/js/demo.js"></script>

</html>