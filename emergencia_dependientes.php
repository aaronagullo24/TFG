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
    echo "The email message was sent.";
}
