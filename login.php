<?php
session_start();
include_once "conectar.php";
if (isset($_REQUEST['nombre'])) {
    $nombre = $_REQUEST['nombre'];
    $password = $_REQUEST['password'];
    $conexion = conectar();
    //seleccionarias el campo password
    $sql = "SELECT * FROM voluntario WHERE Correo=:Correo";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([":Correo" => $nombre]);
    $voluntario = $consulta->fetch(PDO::FETCH_OBJ);


    $sql2 = "SELECT * FROM dependiente WHERE Correo=:Correo";
    $consulta2 = $conexion->prepare($sql2);
    $consulta2->execute([":Correo" => $nombre]);
    $dependiente = $consulta2->fetch(PDO::FETCH_OBJ);


    if ($consulta->rowCount() != 0) {
        if ($password == $voluntario->Password) {
            $_SESSION['usuario'] = $voluntario;
            header("Location:ver_perfil_voluntario.php");
        } else {
            $mensaje = "error";
            header("Location: login.php?mensaje=$mensaje");
        }
    } else if ($consulta2->rowCount() != 0) {
        if ($password == $dependiente->Password) {
            $_SESSION['dependiente'] = $dependiente;
            header("Location:ver_perfil_dependientes.php");
        } else {
            $mensaje = "error";
            header("Location: login.php?mensaje=$mensaje");
        }
    } else {
        $mensaje = "error";
        header("Location: login.php?mensaje=$mensaje");
    }
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


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body style="background-image:url(resources/ayudar.jpg)">
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

    <div class="container mt-1" >
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto" >
                <div class="card card-signin my-5" style="border: solid 3px black; background-color: #28F725;">
                    <div class="card-body" >
                        <h5 class="card-title text-center">INICIO SESIÓN</h5>
                        <form class="form-signin" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                            <div class="form-label-group">

                                <label for="nombre">Correo</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" required>

                            </div>

                            <div class="form-label-group">
                                <label for="inputPassword">Contraseña</label>
                                <input type="password" id="password" name="password" class="form-control"required>

                            </div>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase mt-3" type="submit">ENTRAR</button>
                            <hr class="my-4">

                            <?php

                            if (isset($_REQUEST['mensaje'])) {
                            ?>
                                <br>
                                <div class="alert alert-danger">Usuario o contraseña incorrecta</div>
                                <hr class="my-4">
                            <?php
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>

        </div>


        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
</body>

</html>