<?php
session_start();
include_once "conectar.php";
$administrador = $_SESSION['administrador'];
$conexion = conectar();

$id_dependiente = $_REQUEST['dependiente'];


$sentencia = $conexion->prepare("DELETE FROM dependiente WHERE Numero_socio=:Numero_socio");
$resultado = $sentencia->execute(["Numero_socio" => $id_dependiente]);


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
    <script src="js/buscar.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body style="background-color: aquamarine;">

    <!-- menú de navegación -->
    <nav class="navbar navbar-inverse bg-inverse navbar-toggleable-sm sticky-top">

        <div class="navbar-header">

            <a class="navbar-brand" href="inicio_administrador.php">
                <img src="resources/logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo Bootstrap"> Administrador
                <?php
                echo $administrador->nombre;
                ?>
                </p> </a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Desplegar navegación</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Crear
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="crear_voluntario.php">Crear Voluntario</a></li>
                        <li><a href="crear_dependiente.php">Crear Dependiente</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Modificar
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="modificar_voluntario.php">Modificar Voluntario</a></li>
                        <li><a href="modificar_dependiente.php">Modificar Dependiente</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li><a href="#">Chat</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li><a href="#">Parejas</a></li>
            </ul>
        </div>
        <div class="d-flex flex-row justify-content-center">

            <a href="login.php" class="btn btn-outline-danger">Cerrar sesion</a>
        </div>
        </div>
    </nav>
    <br>
    <br>

    <div class="alert alert-success">Eliminador Correctamente</div>
</body>

</html>