<?php
include_once "conectar.php";
$conexion = conectar();
session_start();
$voluntario = $_SESSION['usuario'];
$nombre = $voluntario->Nombre;

?>

<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Oldver</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/mi_libreriaAjax.js"></script>
    <script src="js/AjaxCode.js"></script>
    <script src="js/buscar.js"></script>
    
    
   


</head>

<body style="background-color: aquamarine;">

    <!-- menú de navegación -->
    <nav class="navbar navbar-inverse bg-inverse navbar-toggleable-sm sticky-top">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="ver_perfil_voluntario.php">
            <img src="resources/logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo Bootstrap">
            <?php
            echo $nombre;
            ?> </a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <div class="navbar-nav mr-auto ml-auto text-center">
                <a class="nav-item nav-link " href="solicitar_voluntario.php">Solicitar</a>
                <a class="nav-item nav-link" href="ver_perfil_voluntario.php">Perfil</a>
                <a class="nav-item nav-link " href="calendario.php">Calendario</a>

            </div>
            <div class="d-flex flex-row justify-content-center">

                <a href="login.php" class="btn btn-outline-danger">Cerrar sesion</a>
            </div>
        </div>
    </nav>

    <section class="container my-0 py-4">
        <h3 class="text-uppercase text-center mb-4">Oldver</h3>
        <p class="lead text-center mb-5">Aqui puedes enviar peticiones a nuestros mayores para que puedas ayudarles,
            todos estaran encantados de tenerte </p>

    </section>

    <!--Si tiene ya una solicitud no puede hacer mas -->

    <input class="form-control col-md-3 light-table-filter" data-table="order-table" type="text" placeholder="buscar..">
    <br>
    <table class="table table-hover order-table" id="tabla" >
        <thead class="thead-dark">
            <tr>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Nombre</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Provincia</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Localidad</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Necesidad</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Contactar</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $sql = "SELECT * FROM dependiente where Solicitud IS NULL";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();


            while ($voluntario = $consulta->fetch(PDO::FETCH_OBJ)) {
            ?>

                <tr>

                    <td><?php echo $voluntario->Nombre ?></td>
                    <td><?php echo $voluntario->Provincia ?></td>
                    <td><?php echo $voluntario->Localidad ?></td>
                    <td><?php echo $voluntario->Necesidad ?></td>
                    <td><a>Contactar</a></td>
                </tr>

            <?php } ?>