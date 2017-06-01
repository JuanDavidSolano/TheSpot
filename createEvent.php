<?php
include 'conexion.php';
session_start();
//Recibir los datos
if (!isset($_SESSION["user"])) {
    header("Location:index.php");
}
if (!empty($_POST)) {
    $eventname = $_POST["event-name"];
    $eventowner = $_POST["event-owner"];
    $eventcategory = $_POST["event-category"];
    $picture = $_FILES["file"]["name"];
    $date = $_POST["event-date"];
    $place = $_POST["event-place"];
    $price = $_POST["event-price"];
    $descripcion = $_POST["event-description"];
    //Consulta para insertar
    $insert = "INSERT INTO eventos(name,owner,category,img,descripcion,place,price,date) VALUES ('$eventname','$eventowner','$eventcategory','$picture','$descripcion','$place','$price','$date')";
//Ejecutar consulta
    $result = mysqli_query($conexion, $insert);
    if (!$result) {
        
    } else {
        if ($_FILES["file"]["error"] > 0) {
        } else {
            move_uploaded_file($_FILES["file"]["tmp_name"], "assets/imgevents/" . $_FILES["file"]["name"]);
        }
        header("location:index.php");
    }
}
?>

<html>
    <link href="css/StyleCreateEvent.css" type="text/css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Baloo" rel="stylesheet"> 
    <head>
        <meta charset="UTF-8">
        <title>Inicio</title>
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

            <form enctype="multipart/form-data" action="createEvent.php" class="col s12" method="post">
                <div class="row">
                    <div class="input-field col s4">
                        <input name="event-name" id="event-name" type="text" class="validate" required>
                        <label for="event-name">Event Name</label>
                    </div>
                    <div class="input-field col s4">
                        <input name="event-owner" id="event-owner" type="text" class="validate" required>
                        <label for="event-owner">Event Owner</label>
                    </div>
                    <div class="input-field col s4">
                        <input name="event-category" id="event-category" type="text" class="validate" required>
                        <label for="event-category">Event Category</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s8 offset-s2">
                        <textarea maxlength="100" name="event-description" id="event-description" class="materialize-textarea"></textarea>
                        <label for="event-description">Description</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <input name="event-place" id="event-place" type="text" class="validate" required>
                        <label for="event-place">Event Place</label>
                    </div>
                    <div class="input-field col s4">
                        <input name="event-price" id="event-price" type="text" class="validate" required>
                        <label for="event-price">Event Price</label>
                    </div>
                    <div class="input-field col s4">
                        <input name="event-date" id="event-date" type="text" class="validate" required>
                        <label for="event-date">Event Date</label>
                    </div>
                </div>
                <div class="row">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>File</span>
                            <input name="file" type="file" required>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>

                </div>
                <center>
                    <button class="btn waves-effect waves-light" type="submit" name="action">Send
                        <i class="material-icons right">send</i>
                    </button>
                </center>

            </form>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/materialize.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".button-collapse").sideNav();
        })

    </script>
    <script >

        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15 // Creates a dropdown of 15 years to control year
        });

    </script>
</body>

</html>
