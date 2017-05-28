<?php
include 'conexion.php';
session_start();
if (isset($_SESSION["user"])) {
    header("Location: Inicio.php");
}
if (!empty($_POST)) {
    $error = '';
    $user = $_POST['user'];
    $password = $_POST['password'];
    $sha1_password = sha1($password);
//Conectar base de datos
//Consulta
    $consulta = "SELECT * FROM users WHERE user='$user' and password='$sha1_password'";
    $result = mysqli_query($conexion, $consulta);

    $filas = mysqli_num_rows($result);
    if ($filas > 0) {
        $filas = $result->fetch_assoc();
        $_SESSION['user'] = $filas['user'];
        $_SESSION['tipo'] = $filas['tipo'];
        header("location: Inicio.php");
    } else {
        $error = 'user or password wrong';
    }
}
?>
<!DOCTYPE html>

<html>
    <link href="css/StyleIndex.css" type="text/css" rel="stylesheet"/>
    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
        <!-- Compiled and minified CSS -->
        
        <title>The Spot</title>
    </head>
    <body>
        <form action="<?php $_SERVER['PHP_SELF']; ?>"  method="post" class="form_logIn">
            <h2 class="form__titulo">Login</h2>
            <div class="contenedor-inputs">
                <input type="text" placeholder="&#9000;User" name="user" class="input-100" required>
                <input type="password" placeholder="&#128273;Password" name="password" class="input-100" required>
                <input type="submit" value="&#128682;Log In" class="input-48">
                <input type="button" src="Register.html" value="&#128390;Registro" onclick = "location = 'Register.php'"class="input-48">
                <p class="form__link"><a href="Invitado.php">Enter as guest</a></p>
                <p><?php echo isset($error) ? utf8_decode($error) : ''; ?></p>
            </div>
        </form>
    </body>
    
    
</html>