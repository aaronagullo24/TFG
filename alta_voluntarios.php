<?php
include_once "base_datos.php";
$conexion = conectar();
$operacion = [];

$DNI = $_REQUEST['DNI'];
$Nombre =  $_REQUEST['Nombre'];
$Titulacion =  $_REQUEST['titulacion'];
$Nick = $_REQUEST['Nick'];
$Edad = $_REQUEST['edad'];
$Correo = $_REQUEST['correo'];
$provinciaList = $_REQUEST['provinciaList'];
$localidadList = $_REQUEST['localidadList'];
$Direccion = $_REQUEST['direccion'];
$Password = $_REQUEST['password'];



try {
    $sql = "INSERT INTO voluntario (DNI,Nombre,Titulacion,Nick,Edad,Correo,Provincia,Localidad,Direccion,Password) value 
    (:DNI,:Nombre,:Titulacion,:Nick,:Edad,:Correo,:Provincia,:Localidad,:Direccion,:Password)";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([
        ":DNI" => $DNI, ":Nombre" => $Nombre, ":Titulacion" => $Titulacion, ":Nick" => $Nick,
        ":Edad" => $Edad, ":Correo" => $Correo, ":Provincia" => $provinciaList, ":Localidad" => $localidadList, ":Direccion" => $Direccion,
        ":Password" => $Password
    ]);
    $operacion['alta'] = true;
} catch (PDOException $e) {
    $operacion['alta'] = false;
}

echo json_encode($operacion);
