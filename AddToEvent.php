<?php

session_start();
include 'conexion.php';

if (!isset($_SESSION["user"])) {
//    header("Location:index.php");
}
$user = $_SESSION['user'];
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
            $e = true;
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
        $new=$filas2["good"]+1;
        print_r($new);
        $query = "UPDATE eventos SET good='$new' WHERE id='$idE'";
        $result = mysqli_query($conexion, $query);
        $newas=$filas2["dislike"]-1;
        if($newas>0){
        $query4 = "UPDATE eventos SET dislike='$new' WHERE id='$idE'";
        $result = mysqli_query($conexion, $query4);
        }
    }
}else{
        $query = "UPDATE users SET favs='$idE' WHERE user='$user'";
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
        $new=$filas2["good"]+1;
        $query4 = "UPDATE eventos SET good='$new' WHERE id='$idE'";
        $result = mysqli_query($conexion, $query4);
        $newas=$filas2["dislike"]-1;
        if($newas>0){
        $query4 = "UPDATE eventos SET dislike='$newas' WHERE id='$idE'";
        $result = mysqli_query($conexion, $query4);
        }
}
header("Location:Event.php?id=$idE&e=0&a=1");
