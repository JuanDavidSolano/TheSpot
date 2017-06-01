<?php

include 'conexion.php';
$id = $_GET["id"];
$user = $_GET["us"];
$query = "SELECT * FROM users WHERE user='$user'";
$result = mysqli_query($conexion, $query);
$filas = $result->fetch_assoc();
$new = "";
$pos = "";
$fav = $filas["favs"];
$favs = preg_split("~,~", $fav);
print_r($favs);
$tam = count($favs);
for ($i = 0; $i <= $tam - 1; $i++) {
    if ($favs[$i] == $id) {
        $pos = $i;
    }
}
for ($i = 0; $i <= $tam - 1; $i++) {
    if ($i != $pos) {
        if ($new == "") {
            $new = $favs[$i];
        } else {
            $new = $new . "," . $favs[$i];
        }
    }
}
if (pos != "") {
    $query = "UPDATE users SET favs='$new' WHERE user='$user'";
    $result = mysqli_query($conexion, $query);
//ELIMINAR DE EL EVENTO
    $query = "SELECT * FROM eventos WHERE id='$id'";
    $result = mysqli_query($conexion, $query);
    $filas = $result->fetch_assoc();
    $participantes = preg_split("~,~", $filas["participants"]);
    $tam = count($participantes);
    for ($i = 0; $i <= $tam - 1; $i++) {
        if ($participantes[$i] == $user) {
            $pos = $i;
        }
    }
    for ($i = 0; $i <= $tam - 1; $i++) {
        if ($i != $pos) {
            if ($new == "") {
                $new = $participantes[$i];
            } else {
                $new = $new . "," . $participantes[$i];
            }
        }
    }
    $query = "UPDATE eventos SET participants='$new' WHERE id='$id'";
    $result = mysqli_query($conexion, $query);
    $new = $filas["slots"] - 1;
    $query = "UPDATE eventos SET slots='$new' WHERE id='$id'";
    $result = mysqli_query($conexion, $query);
    $new = $filas["good"]-1;
    $query4 = "UPDATE eventos SET good='$new' WHERE id='$id'";
    $result = mysqli_query($conexion, $query4);
}



header("Location: Favorites.php");


