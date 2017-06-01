<?php

session_start();
if ($_SESSION['tipo'] == 1 ||$_SESSION['tipo'] == 3 ) { 
    session_destroy();
    header('Location:index.php');
}else{
    session_destroy();
    header('Location:Register.php');
}



