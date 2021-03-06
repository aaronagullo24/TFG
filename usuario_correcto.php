<?php

session_start();
if (isset($_SESSION['alta'])) {
    $Correo = $_SESSION['alta'];
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $from = "admin@oldver.es";
    $to = $Correo;
    $subject = "Dado de alta correctamente";
    $message = "Muchas gracias por darse de alta en nuestro servicio de voluntarios de oldver para ayudar a la gente que lo necesita,
    ya puede entrar a su perfil. 
    Muchas gracias.";
    $headers = "From:" . $from;
    mail($to, $subject, $message, $headers);
    unset($_SESSION['alta']);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Oldver</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">


</head>

<body style="background-color: #4FD53C;">

    <!-- menú de navegación -->
    <nav class="navbar navbar-inverse bg-inverse navbar-toggleable-sm sticky-top">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="index.html">
            <img src="resources/logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo Bootstrap">
            Oldver </a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <div class="navbar-nav mr-auto ml-auto text-center">
                <a class="nav-item nav-link " href="index.html">Inicio</a>
                <a class="nav-item nav-link" href="nosotros.html">Nosotros</a>
                <a class="nav-item nav-link " href="servicio.html">Servicios</a>
                <a class="nav-item nav-link" href="contactar.html">Contacto</a>
            </div>
            <div class="d-flex flex-row justify-content-center">
                <a href="elejis_tipo_usuario.html" class="btn btn-outline-primary mr-2">Nuevo Usuario</a>
                <a href="login.php" class="btn btn-outline-danger">Entrar</a>
            </div>
        </div>
    </nav>

    <br>
    <br>
    <div class="alert alert-success text-center">¡USUARIO DADO DE ALTA CORRECTAMENTE!</div>
</body>

</html>