<?php
session_start();
if (!isset($_SESSION['administrador'])) {
    header("Location: login.php");
}
$administrador = $_SESSION['administrador'];

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

<body style="background-color: aquamarine;">

    <!-- menú de navegación -->
    <nav class="navbar navbar-inverse bg-inverse navbar-toggleable-sm sticky-top">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="inicio_administrador.php.php">
            <img src="resources/logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo Bootstrap">
            Administrador
            <?php
            echo $administrador->nombre;
            ?>
            </p> </a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <div class="navbar-nav mr-auto ml-auto text-center">
                <a class="nav-item nav-link " href="">Crear Dendiente</a>
                <a class="nav-item nav-link " href="crear_voluntario.php">Crear Voluntario</a>
                <a class="nav-item nav-link" href="">Modificar Usuario</a>
                <a class="nav-item nav-link " href="">Modificar Chat</a>
                <a class="nav-item nav-link " href="">Modificar Parejas</a>
            </div>
            <div class="d-flex flex-row justify-content-center">

                <a href="login.php" class="btn btn-outline-danger">Cerrar sesion</a>
            </div>
        </div>
    </nav>

    <br>
    <br>
    <div class="alert alert-success">¡USUARIO DADO DE ALTA CORRECTAMENTE!</div>
</body>

</html>