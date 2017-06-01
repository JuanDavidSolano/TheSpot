<?php
include 'conexion.php';
$query = "SELECT * FROM users";
    $result = mysqli_query($conexion, $query);
    $filas = $result->fetch_assoc();
    while ($fila = mysqli_fetch_assoc($result)) {
        $user=$fila["user"];
        $favs = preg_split("~,~", $fila["favs"]);
        $tam = count($favs);
        for ($i = 0; $i <= $tam - 1; $i++) {
            if ($favs[$i]==$id) {
                $pos=$i;
            }
        }
        $newfavs="";
        for ($i = 0; $i <= $tam - 1; $i++) {
            if ($i!=$pos) {
                if ($newfavs=="") {
                    $newfavs=$favs[$i];
                }else{
                    $newfavs=$newfavs.",".$favs[$i];
                }
            }
        }
        $query = "UPDATE users SET favs='$new' WHERE user='$user'";
        $result= mysqli_query($conexion, $query);
    }

    header("Location: Favorites.php");


