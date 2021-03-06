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

$xml = simplexml_load_file('provinciasypoblaciones.xml');
$result = $xml->xpath("/lista/provincia/nombre | /lista/provincia/@id");

for ($i = 0; $i < count($result); $i += 2) {
    $e = $i + 1;
    if ($result[$i] == $Provincia) {
        $Provincia = UTF8_DECODE($result[$e]);
    }
}

try {
    $sql = "INSERT INTO dependiente (Numero_socio,Nombre,Provincia,Localidad,Fecha_nacimiento,Correo,Necesidad,Password) value 
    (:Numero_socio,:Nombre,:Provincia,:Localidad,:Fecha_nacimiento,:Correo,:Necesidad,:Password)";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([
        ":Numero_socio" => null, ":Provincia" => $Provincia, ":Localidad" => $Localidad,
        ":Correo" => $Correo, ":Necesidad" => $Necesidad, ":Nombre" => $Nombre, ":Fecha_nacimiento" => $Fecha_nacimiento,
        ":Password" => $Password
    ]);
    $_SESSION['alta'] = $Correo;
    
    $operacion['alta'] = true;
} catch (PDOException $e) {
    $operacion['alta'] = false;
}


echo json_encode($operacion);
