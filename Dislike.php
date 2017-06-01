<?php

include 'conexion.php';
session_start();
include 'conexion.php';
if (!isset($_SESSION["user"])) {
    header("Location:index.php");
}
$id = $_GET["id"];
$query = "SELECT * FROM eventos WHERE id='$id'";
$result = mysqli_query($conexion, $query);
$filas = $result->fetch_assoc();
$new = $filas["dislike"] - 1;
if ($new > 0) {
    $query = "UPDATE eventos SET dislike='$new' WHERE id='$id'";
    $result = mysqli_query($conexion, $query);
}

header("Location:index.php");
