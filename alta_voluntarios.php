<?php
include_once "conectar.php";
$conexion = conectar();
$operacion = [];


$Nombre =  $_REQUEST['Nombre'];
$Correo = $_REQUEST['correo'];
$Password = $_REQUEST['password'];
$titulacion = $_REQUEST['titulacion'];


try {
    $sql = "INSERT INTO voluntario (Numero_socio,Nombre,Correo,Titulacion,Password) value 
    (:Numero_socio,:Nombre,,:Correo,:Titulacion,:Password)";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([
        ":Numero_socio"=>null,
        ":Nombre" => $Nombre,
        ":Correo" => $Correo,
        ":Titulacion"=>$titulacion,
        ":Password" => $Password
    ]);
    $operacion['alta'] = true;
} catch (PDOException $e) {
    $operacion['alta'] = false;
}

echo json_encode($operacion);
