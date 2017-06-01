<?php
session_start();
include 'conexion.php';
if (!isset($_SESSION["user"])) {
    header("Location:index.php");
}
$user=$_GET['user'];
$id=$_GET['id'];
$query="SELECT * FROM users WHERE user='$user'";
$result= mysqli_query($conexion, $query);
$filas = $result->fetch_assoc();
print_r($filas);


