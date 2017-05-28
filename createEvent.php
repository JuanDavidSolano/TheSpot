<?php
session_start();
require 'conexion.php';
if (!isset($_SESSION["user"])) {
    header("Location:Index.php");
}
$user = $_SESSION['user'];
$query = "SELECT * FROM users WHERE user = '$user'";
$result = mysqli_query($conexion, $query);
$filas = $result->fetch_assoc();
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
                <?php if ($_SESSION['tipo'] == 3) { ?>
                <li ><a class="mycolor" href="">Admin</a> </li>
                <?php } ?>
                <li><a class="mycolor" href="Inicio.php">Look Events</a></li>
                <?php if ($_SESSION['tipo'] == 1 || $_SESSION['tipo'] == 3) { ?>
                <li><a class="mycolor" href="createEvent.php">Create Event</a></li>
                <li><a class="mycolor" href="">Favorites</a></li>
                <li><a class="mycolor" href="logout.php">LogOut</a></li>
                <?php } ?>
                <?php if ($_SESSION['tipo'] == 2) { ?>
                <li><a class="mycolor" href="logout.php">Create Account</a></li>
                <?php } ?>
            </ul>
            <ul class=" side-nav yellow darken-3" id="mobile-demo">
                <?php if ($_SESSION['tipo'] == 3) { ?>
                <li><a class="mycolor" href="">Admin</a> </li>
                <?php } ?>
                <li><a class="mycolor" href="Inicio.php">Look Events</a></li>
                <?php if ($_SESSION['tipo'] == 1 || $_SESSION['tipo'] == 3) { ?>
                <li><a class="mycolor" href="createEvent.php">Create Event</a></li>
                <li><a class="mycolor" href="">Favorites</a></li>
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
            <form class="col s12">
                <div class="row">
                    <div class="input-field col s4">
                      <input id="event-name" type="text" class="validate">
                      <label for="event-name">Event Name</label>
                  </div>
                  <div class="input-field col s4">
                      <input id="event-owner" type="text" class="validate">
                      <label for="event-owner">Event Owner</label>
                  </div>
                  <div class="input-field col s4">
                      <input id="event-category" type="text" class="validate">
                      <label for="event-category">Event Category</label>
                  </div>
              </div>
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
