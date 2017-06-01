<?php
include 'conexion.php';
//Recibir los datos

if (!empty($_POST)) {
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $mail = $_POST["mail"];
    $user = $_POST["user"];
    $password = $_POST["password"];
    $sha1_password = sha1($password);
    $error = '';
//verificar que el usuario no se repita
    $verif_user = mysqli_query($conexion, "SELECT * FROM users WHERE user='$user'");
    if (mysqli_num_rows($verif_user) > 0) {
        $error = 'There is another account with that user';
    } else {
        $verif_mail = mysqli_query($conexion, "SELECT * FROM users WHERE mail='$mail'");
        if (mysqli_num_rows($verif_mail) > 0) {
            $error = 'There is another account with that mail';
        } else {
            //Consulta para insertar
            $insert = "INSERT INTO users(name,lastname,mail,user,password) VALUES ('$name','$lastname','$mail','$user','$sha1_password')";
//Ejecutar consulta
            $result = mysqli_query($conexion, $insert);
            if (!$result) {
                $error = 'Error in registration process';
            } else {
                header("location:index.php");
            }
            mysqli_free_result($result);
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="css/StyleRegister.css" type="text/css" rel="stylesheet"/>
        <script src="assets/js/validate.js"></script>
        <title>Registro</title>
    </head>
    <body>
        <form action="Register.php" method="post" class="form-register" onsubmit="return validar();">
            <h2 class="form__titulo">Create account</h2>
            <div class="contenedor-inputs">
                <input type="text" id="name" name="name" placeholder="Name" class="input-48" required>
                <input type="text" id="lastname" name="lastname" placeholder="Lastname" class="input-48" required>
                <input type="email" id="mail" name="mail" placeholder="Example@gmail.com" class="input-100" required>
                <input type="text" id="user" name="user" placeholder="User" class="input-48" required>
                <input type="password" id="password" name="password" placeholder="Password" class="input-48" required>
                <input type="submit" value="Register" class="btn-register">
                <p class="form__link">Already have an account? <a href="index.php"> Log-In</a></p>
                <p><?php echo isset($error) ? utf8_decode($error) : ''; ?></p>
            </div>
        </form>
    </body>
</html>