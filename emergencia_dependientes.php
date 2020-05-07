<?php
include_once "conectar.php";
$conexion = conectar();
session_start();
if (!isset($_SESSION['dependiente'])) {
    header("Location: login.php");
}
$dependiente = $_SESSION['dependiente'];

if ($dependiente->voluntario != null) {

    $sql = "SELECT * FROM dependiente WHERE Numero_socio=:Numero_socio;";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([":Numero_socio" => $dependiente->Numero_socio]);
    $voluntario = $consulta->fetch(PDO::FETCH_OBJ);

    $sql1 = "SELECT * FROM voluntario WHERE Numero_socio=:Numero_socio;";
    $consulta1 = $conexion->prepare($sql1);
    $consulta1->execute([":Numero_socio" => $voluntario->Numero_socio]);
    $voluntario1 = $consulta1->fetch(PDO::FETCH_OBJ);

    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $from = "admin@oldver.es";
    $to = $voluntario->Correo;
    $subject = "Emergencia";
    $message = "Su dependiente a enviado un mensaje de ayuda, corre";
    $headers = "From:" . $from;
    mail($to, $subject, $message, $headers);
}

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
                <a class="nav-item nav-link " href="perfil_pareja_dependiente.php">Perfil del Voluntario</a>
                <a class="nav-item nav-link text-danger" href="emergencia_dependientes.php">Emergencias</a>
            </div>
            <div class="d-flex flex-row justify-content-center">

                <a href="login.php" class="btn btn-outline-danger">Cerrar sesion</a>
            </div>
        </div>
    </nav>
    <div align="center" class="mt-3">
        <a href="tel:+34663192984"><img src="resources/sos.jpg" /></a>

        <h1>Pulse para llamar a los servicio de emergencia</h1>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>