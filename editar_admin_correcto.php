<?php
session_start();
if (!isset($_SESSION['administrador'])) {
    header("Location: login.php");
}
include_once "conectar.php";
include_once "cabecera.php";
$conexion = conectar();
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
    <script src="js/editar_pefil_voluntario.js"></script>
    <script src="js/mi_libreriaAjax.js"></script>
    <script src="js/AjaxCode.js"></script>
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
    <div class="alert alert-success text-center">¡Cambios Guardados Correctamente!</div>
</body>

</html>