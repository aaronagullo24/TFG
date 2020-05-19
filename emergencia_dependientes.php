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
    $consulta1->execute([":Numero_socio" => $voluntario->voluntario]);
    $voluntario1 = $consulta1->fetch(PDO::FETCH_OBJ);

    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $from = "admin@oldver.es";
    $to = $voluntario1->Correo;
    $subject = "Emergencia";
    $message = "Tu dependiente ha pulsado el botón de SOS y necesita tu apoyo. ¡Cuenta contigo, en estos duros momentos!";
    $headers = "From:" . $from;
    mail($to, $subject, $message, $headers);
}

if (!isset($_SESSION['dependiente'])) {
    header("Location: login.php");
}
include_once("funciones.php");
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

    <?php
    dependiente($nombre);
    ?>
    <div align="center" class="mt-3">
        <a href="tel:+34684105254"><img src="resources/sos.jpg" /></a>

        <h1>Pulse para llamar a los servicio de emergencia</h1>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>