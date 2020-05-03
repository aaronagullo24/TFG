<?php
session_start();
if (!isset($_SESSION['dependiente'])) {
    header("Location: login.php");
}
$dependiente = $_SESSION['dependiente'];
$nombre = $dependiente->Nombre;
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
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="inicio_dependientes
        .php">
            <img src="resources/logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo Bootstrap">
            <?php
            echo $nombre;
            ?>
            </p> </a>
        <div class="collapse navbar-collapse " id="navbarTogglerDemo01">
            <div class="navbar-nav mr-auto ml-auto text-center">
                <a class="nav-item nav-link " href="solicitar_dependientes.php" mark>Solicitar</a>
                <a class="nav-item nav-link" href="ver_perfil_dependientes.php">Perfil</a>
                <a class="nav-item nav-link " href="calendario_dependiente.php">Calendario</a>
                <a class="nav-item nav-link " href="chat_voluntario.php">Chat</a>
                <a class="nav-item nav-link text-danger" href="emergencia_voluntario.php">Emergencias</a>
            </div>
            <div class="d-flex flex-row justify-content-center">

                <a href="login.php" class="btn btn-outline-danger">Cerrar sesion</a>
            </div>
        </div>
    </nav>
    <div align="center">
        <img src="resources/logo.png" alt="Logo OLDVER" height="30%" width="30%" style="margin-top: 2%;">
        <br>
        <br>
        <br>
        <p class="lead text-center mb-5">En esta pagina recivira la ayuda que necesita.
        </p>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>