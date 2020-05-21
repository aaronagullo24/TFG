<?php
session_start();
include_once "conectar.php";
if (isset($_REQUEST['nombre'])) {
    $nombre = $_REQUEST['nombre'];
    $password = $_REQUEST['password'];
    $conexion = conectar();


    $sql = "SELECT * FROM administradores WHERE Correo=:Correo";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([":Correo" => $nombre]);
    $administrador = $consulta->fetch(PDO::FETCH_OBJ);



    if ($password == $administrador->password) {
        $_SESSION['administrador'] = $administrador;
        header("Location:inicio_administrador.php");
    } else {
        $mensaje = "error";
        header("Location: login_admin.php?mensaje=$mensaje");
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

<body style="background-color: #4FD53C;">

    <nav class="navbar navbar-inverse bg-inverse navbar-toggleable-sm sticky-top">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="index.html">
            <img src="resources/logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo Bootstrap">
            Oldver </a>

    </nav>

    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">ACCESO ADMINISTRADORES</h5>
                        <form class="form-signin" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                            <div class="form-label-group">

                                <label for="nombre">Correo</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Correo">

                            </div>

                            <div class="form-label-group">
                                <label for="inputPassword">Password</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required>

                            </div>
                            <br>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">ENTRAR</button>
                            <hr class="my-4">

                            <?php

                            if (isset($_REQUEST['mensaje'])) {
                            ?>
                                <br>
                                <div class="alert alert-danger">Usuario incorrecto</div>
                                <hr class="my-4">
                            <?php
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>