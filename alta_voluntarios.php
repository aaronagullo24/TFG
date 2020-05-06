<?php
include_once "conectar.php";
$conexion = conectar();
session_start();
$operacion = [];


$Nombre =  $_REQUEST['Nombre'];
$Correo = $_REQUEST['correo'];
$Password = $_REQUEST['password'];
$titulacion = $_REQUEST['titulacion'];
$descripcion = $_REQUEST['descripcion'];
$experiencia = $_REQUEST['experiencia'];

try {
    $sql = "INSERT INTO voluntario (Numero_socio,Nombre,Correo,Titulacion,Password,descripcion,experiencia) value 
    (:Numero_socio,:Nombre,:Correo,:Titulacion,:Password,:descripcion,:experiencia)";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([
        ":Numero_socio" => null,
        ":Nombre" => $Nombre,
        ":Correo" => $Correo,
        ":Titulacion" => $titulacion,
        ":Password" => $Password,
        ":descripcion" => $descripcion,
        ":experiencia" => $experiencia
    ]);
    $_SESSION['alta'] = $Correo;
    
    $operacion['alta'] = true;
    
} catch (PDOException $e) {
    $operacion['alta'] = false;
}

echo json_encode($operacion);
