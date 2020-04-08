<?php
include_once "conectar.php";
$conexion = conectar();
session_start();
$voluntario = $_SESSION['usuario'];
$nombre = $voluntario->Nombre;


$Numero_Socio_dependiente = $_REQUEST['dependiente'];


try {
    $sql = "INSERT INTO solicitudes (voluntario,dependiente) value 
    (:voluntario,:dependiente)";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([
        ":voluntario" => $voluntario->Numero_socio,
        ":dependiente" => $Numero_Socio_dependiente
    ]);
} catch (PDOException $e) {
    echo $e->getMessage();
}
