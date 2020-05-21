<?php
session_start();
include_once "conectar.php";
include_once "cabecera.php";
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

<body style="background-color: #4FD53C;">

    <?php
    administrador($administrador);
    ?>
    <br>
    <br>

    <div class="alert alert-success text-center">Eliminador Correctamente</div>
</body>

</html>