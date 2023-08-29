<?php
include_once '../../../controllers/utilisateurController.php';
include_once '../../../models/utilisateur.php';

$error = "";


$utilisateur = null;
$utilisateurController = new UtilisateurController();
$rolesAutorises = ["admin", "organisateur", "participant"];

if (
    isset($_POST["submit"]) 
) {
    if(
        !empty($_POST["nom"]) && 
        !empty($_POST["prenom"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["age"]) &&
        !empty($_POST["role"])
        
        ){
            if (in_array($_POST["role"], $rolesAutorises)) {
            $utilisateur = new Utilisateur(
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['email'],
                intval($_POST['age']),
                $_POST['role'],
                $_POST['mdp'],
            );
            $utilisateurController->modifierUtilisateur($utilisateur,$_GET["id"]);
            header('Location:showUser.php');
        }
        else {
            $error = "Rôle non autorisé. Changez SVP!!!";
        }

    }}
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
                                <h4 class="title">Edit User</h4>
                            </div>
                            <div class="content">
                            <?php
    if (isset($_GET['id'])) {
        $utilisateur = $utilisateurController->getUserById($_GET['id'])

    ?>
    <form action="editUser.php?id=<?php echo $_GET['id']; ?>" method="post">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="prenom">First Name</label>
                    <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Enter your First Name" value="<?php echo $utilisateur['prenom'] ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nom">Last Name</label>
                    <input type="text" name="nom" id="nom" class="form-control" placeholder="Enter your Last Name" value="<?php echo $utilisateur['nom'] ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="xxx@xxx.xx" value="<?php echo $utilisateur['email'] ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" class="form-control" placeholder="Enter your age" value="<?php echo $utilisateur['age'] ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="admin">Admin</option>
                        <option value="participant">Participant</option>
                        <option value="organisateur">Organisateur</option>
                    </select>
                </div>
            </div>
        </div>
<!--
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="mdp">Password</label>
                    <input type="password" name="mdp" id="mdp" class="form-control" placeholder="Enter your password" value="<?php echo $utilisateur['mdp'] ?>">
                </div>
            </div>
        </div>-->

        <button type="submit" name="submit" class="btn btn-info btn-fill pull-right">Confirm</button>
        <div class="clearfix"></div>
    </form>
    <?php } ?>

    <?php if (!empty($error)) { ?>
        <div class="error-message">
            <?php echo $error; ?>
        </div>
    <?php } ?>
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