<?php
session_start();
include 'conexion.php';
if (!isset($_SESSION["user"])) {
    header("Location:index.php");
}

function showFavs() {
    include 'conexion.php';
    $user = $_SESSION['user'];
    $query = "SELECT * FROM users WHERE user = '$user'";
    $result = mysqli_query($conexion, $query);
    $filas = $result->fetch_assoc();
    $favs = preg_split("~,~", $filas["favs"]);
    $tam = count($favs);
    if ($filas["favs"]!="") {
        for ($i = 0; $i <= $tam - 1; $i++) {
            $query = "SELECT * FROM eventos WHERE id = '$favs[$i]'";
            $result = mysqli_query($conexion, $query);
            $fila = $result->fetch_assoc();
            echo'<div class="col s6">';
            echo'<div class="card">';
            echo'<div class="card-image">';
            echo'<img class="img" src="assets/imgevents/' . $fila["img"] . '">';
            echo'<span class="card-title back">' . $fila["name"] . '</span>';
            echo'<a href="Event.php?id=' . $fila["id"] . '&e=0" class="btn-floating halfway-fab waves-effect amber darken-3"><i class="material-icons">add</i></a>';
            echo'<a href="RemoveFavorite.php?id=' . $fila["id"] . '&us=' . $user . '" class="btn-floating material-icons left waves-effect halfway-fab waves-light red"><i class="material-icons">delete</i></a>';
            echo'</div>';
            echo'<div class="card-content prueba">';
            echo'<p>' . $fila["descripcion"] . '</p>';
            echo'</div>';
            echo'</div>';
            echo'</div>';
        }
    }
}
?>
<html>
    <link href="css/StyleFavorites.css" type="text/css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Baloo" rel="stylesheet"> 
    <head>
        <meta charset="UTF-8">
        <title>Favorites</title>
        <!-- Compiled and minified CSS -->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
    </head>
    <body>
        <nav class="fixxed">
            <div class="nav-wrapper yellow darken-2">
                <a href="Inicio.php" class="brand-logo"><img src="img/logo.png"></a>
                <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down black-text">
                    <li><a class="mycolor" href="Inicio.php" >Look Events</a></li>
                    <?php if ($_SESSION['tipo'] == 1 || $_SESSION['tipo'] == 3) { ?>
                        <li><a class="mycolor" href="createEvent.php">Create Event</a></li>
                        <li><a class="mycolor" href="Favorites.php">Favorites</a></li>
                        <li><a class="mycolor" href="logout.php">LogOut</a></li>
                    <?php } ?>
                    <?php if ($_SESSION['tipo'] == 2) { ?>
                        <li><a class="mycolor" href="logout.php">Create Account</a></li>
                    <?php } ?>
                </ul>
                <ul class=" side-nav yellow darken-3" id="mobile-demo">
                    <li><a class="mycolor" href="Inicio.php">Look Events</a></li>
                    <?php if ($_SESSION['tipo'] == 1 || $_SESSION['tipo'] == 3) { ?>
                        <li><a class="mycolor" href="createEvent.php">Create Event</a></li>
                        <li><a class="mycolor" href="Favorites.php">Favorites</a></li>
                        <li><a class="mycolor" href="logout.php">LogOut</a></li>
                    <?php } ?>
                    <?php if ($_SESSION['tipo'] == 2) { ?>
                        <li><a class="mycolor" href="logout.php">Create Account</a></li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
        <div class="container black-text">
            <div class="row">
                <?php
                showFavs();
                ?>
            </div>
        </div>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/materialize.min.js"></script>
        <script>
            $(document).ready(function () {
                $(".button-collapse").sideNav();
            })
            
        </script>
    </body>

</html>