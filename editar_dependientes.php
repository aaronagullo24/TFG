<?php
include_once "conectar.php";
$conexion = conectar();
$operacion = [];
session_start();

$Nombre =  $_REQUEST['Nombre'];
$Provincia = $_REQUEST['provinciaList'];
$Localidad = $_REQUEST['localidadList'];
$Fecha_nacimiento = $_REQUEST['fecha_nacimiento'];
$Correo = $_REQUEST['correo'];
$Necesidad = $_REQUEST['necesidad'];
$Password = $_REQUEST['password'];

if (is_numeric($Provincia)) {
    $provinciaList = (int) $Provincia;
    $xml = simplexml_load_file('provinciasypoblaciones.xml');
    $resultado = $xml->xpath("/ lista / provincia / nombre | / lista / provincia / @ id");
    $Provincia = UTF8_DECODE($resultado[$provinciaList]);
}


try {
    $sentencia = $conexion->prepare("UPDATE dependiente SET Password=:Password,Nombre=:Nombre,Provincia=:Provincia,Localidad=:Localidad,
        Fecha_nacimiento=:Fecha_nacimiento,Necesidad=:Necesidad
        WHERE Correo =:Correo;");
    $resultado = $sentencia->execute([
        ":Password" => $Password,
        ":Nombre" => $Nombre, ":Provincia" => $Provincia, ":Localidad" => $Localidad, ":Correo" => $Correo, ":Fecha_nacimiento" => $Fecha_nacimiento, 
        ":Necesidad" => $Necesidad
    ]);
    $operacion['alta'] = true;

    unset($_SESSION['usuario']);

    $sql2 = "SELECT * FROM dependiente WHERE Correo=:Correo";
    $consulta2 = $conexion->prepare($sql2);
    $consulta2->execute([":Correo" => $Correo]);
    $dependiente = $consulta2->fetch(PDO::FETCH_OBJ);
    $_SESSION['usuario'] = $dependiente;
} catch (PDOException $e) {
    $operacion['alta'] = false;
}
echo json_encode($operacion);
