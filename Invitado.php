<?php

session_start();
$_SESSION['user'] = 'guest';
$_SESSION['tipo'] = '2';
header("Location:Inicio.php");

