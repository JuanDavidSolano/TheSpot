<?php
session_start();
include 'conexion.php';
if (!isset($_SESSION["user"])) {
    header("Location:index.php");
}
$user = $_SESSION['user'];
$query = "SELECT * FROM users WHERE user = '$user'";
$result = mysqli_query($conexion, $query);
$filas = $result->fetch_assoc();

//echo $_GET['id'];

function showEvent() {
    include 'conexion.php';
    $id = $_GET['id'];
    $query = "SELECT * FROM eventos";
    $result = mysqli_query($conexion, $query);
    while ($fila = mysqli_fetch_assoc($result)) {
        if ($fila["id"] === $id) {
            echo'<div class="col s4">';
            echo'<div class="card-panel yellow darken-2 imagen mypanel">';
            echo'<span class="white-text"></span>';
            echo'<img class="img" src="assets/imgevents/' . $fila["img"] . '">';
            echo'</div>';
            echo'</div>';
            echo'<div class="col s5">';
            echo'<div class="card-panel yellow darken-2 mypanel">';
            echo'<span class="mycolor">';
            echo'<center><a class="tittle">' . $fila["name"] . '</a><br></center>';
            echo'<a>Owner: </a>';
            echo'<a>' . $fila["owner"] . '</a><br>';
            echo'<a>Place: </a>';
            echo'<a>' . $fila["place"] . '</a><br>';
            echo'<a>Price: </a>';
            echo'<a>' . $fila["price"] . '</a><br>';
            echo'<a>Date: </a>';
            echo'<a>' . $fila["date"] . '</a><br>';
            echo'<a>' . $fila["descripcion"] . '</a><br>';
            echo'<center><i class="medium material-icons green-text">thumb_up </i><a class="val">   ' . $fila["good"]. '   </a>';
            echo'<i class="medium material-icons red-text">thumb_down</i><a class="val">   ' . $fila["dislike"] . '</a><br></center>';
            echo'</span> ';
            echo'</div>';
            echo'</div>';
            echo'<div class="col s3 ">';
            echo'<div class="card-panel yellow darken-2">';
            echo'<span class="mycolor" translate="yes">Participants</span><br>';
            $participants = preg_split("~,~", $fila["participants"]);
            for ($i = 0; $i <= $fila["slots"] - 1; $i++) {
                echo '<a>' . $participants[$i] . '</a><br>';
            }
            echo'</div>';
            echo'</div>';
        }
    }
}
?>


<html>
    <link href="css/StyleEvent.css" type="text/css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Baloo" rel="stylesheet"> 
    <head>
        <meta charset="UTF-8">
        <title>Event</title>
        <!-- Compiled and minified CSS -->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

        <div class="container">
            <div class="row">
                <?php showEvent();
                ?>
            </div>
            <?php if ($_SESSION['tipo'] == 3 && $_GET["e"] == 1) { ?>
                <div class="row">
                    <div class="col s4">

                        <div class="card-panel yellow darken-2">
                            <center>
                                <span class="mycolor">DELETE THIS EVENT?</span>
                                <center>
                                    <div class="row">
                                        <?php echo'<a  href="RemoveEvent.php?id=' . $_GET['id'] . '"class="red accent-4 col s4 offset-s1 waves-effect waves-light btn" >YES</a>' ?>
                                        <a href="Inicio.php" class="pulse green col s4 offset-s2 waves-effect waves-light btn">NO</a>
                                    </div>
                                </center>
                            </center>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
            <?php if($_GET['a']!=1 & $_SESSION['tipo']!=2){ ?>
                <div class="row">
                    <div class="col s4">
                        <div class="card-panel yellow darken-2">
                            <center>
                                <span class="mycolor">YOU WANT TO COME?</span>
                                <center>
                                    <div class="row">
                                        <?php echo'<a  href="AddToEvent.php?id=' . $_GET['id'] . '&us=' . $_SESSION["user"] . '" class="pulse green accent-4 col s4 offset-s1 waves-effect waves-light btn" >YES</a>' ?>
                                        <?php echo'<a href="Dislike.php?id=' . $_GET['id'] .'" class=" red col s4 offset-s2 waves-effect waves-light btn">NO</a>' ?>
                                    </div>
                                </center>
                            </center>
                        </div>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>
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

