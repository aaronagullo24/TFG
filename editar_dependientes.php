<?php
include_once "conectar.php";
$conexion = conectar();
$operacion = [];
session_start();
if (!isset($_SESSION['dependiente'])) {
    header("Location: login.php");
}

$Nombre =  $_REQUEST['Nombre'];
$Provincia = $_REQUEST['provinciaList'];
$Localidad = $_REQUEST['localidadList'];
$Fecha_nacimiento = $_REQUEST['fecha_nacimiento'];
$Correo = $_REQUEST['correo'];
$Necesidad = $_REQUEST['necesidad'];
$Password = $_REQUEST['password'];
$xml = simplexml_load_file('provinciasypoblaciones.xml');
$result = $xml->xpath("/lista/provincia/nombre | /lista/provincia/@id");


if (is_numeric($Provincia)) {
    for ($i = 0; $i < count($result); $i += 2) {
        $e = $i + 1;
        if ($result[$i] == $Provincia) {
            $Provincia = UTF8_DECODE($result[$e]);
            
        }
    }
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
    $_SESSION['dependiente'] = $dependiente;
} catch (PDOException $e) {
    $operacion['alta'] = false;
}
echo json_encode($operacion);
