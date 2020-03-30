<?php
include_once "conectar.php";
$conexion = conectar();
$operacion = [];


$Nombre =  $_REQUEST['Nombre'];
$Correo = $_REQUEST['correo'];
$Password = $_REQUEST['password'];



try {
    $sql = "INSERT INTO dependiente (Numero_socio,Nombre,Correo,Password) value 
    (:Numero_socio,:Nombre,:Correo,:Password)";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([
        ":Numero_socio"=>null,
        ":Nombre" => $Nombre,
        ":Correo" => $Correo,
        ":Password" => $Password
    ]);
    $operacion['alta'] = true;
} catch (PDOException $e) {
    $operacion['alta'] = false;
}

echo json_encode($operacion);