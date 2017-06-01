<?php

session_start();


include 'conexion.php';
$user = $_GET["us"];
$idE = $_GET["id"];
$e = 0;
$query = "SELECT * FROM users WHERE user = '$user'";
$result = mysqli_query($conexion, $query);
$filas = $result->fetch_assoc();
$query2 = "SELECT * FROM eventos WHERE id = '$idE'";
$result2 = mysqli_query($conexion, $query2);
$filas2 = $result2->fetch_assoc();
if ($filas["favs"] != null) {
    $favs = preg_split("~,~", $filas["favs"]);
    $tam = count($favs);
    for ($i = 0; $i <= $tam - 1; $i++) {
        if ($favs[$i] == $idE) {
            $e = TRUE;
        }
    }
    if (!$e) {
        $new = $filas["favs"] . "," . $idE;
        $query = "UPDATE users SET favs='$new' WHERE user='$user'";
        $result = mysqli_query($conexion, $query);
        $new = $filas2["slots"] + 1;
        $query = "UPDATE eventos SET slots='$new' WHERE id='$idE'";
        $result = mysqli_query($conexion, $query);
        if ($filas2["participants"] != "") {
            $new = $filas2["participants"] . "," . $user;
            $query = "UPDATE eventos SET participants='$new' WHERE id='$idE'";
            $result = mysqli_query($conexion, $query);
        } else {
            $query = "UPDATE eventos SET participants='$user' WHERE id='$idE'";
            $result = mysqli_query($conexion, $query);
        }
    }

}
header("Location:Event.php?id=$idE&e=0");
