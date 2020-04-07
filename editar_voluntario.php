<?php
session_start();
include_once "conectar.php";
$conexion = conectar();

$voluntario = $_SESSION['usuario'];

$Nombre = $_REQUEST['Nombre'];
$Titulacion = $_REQUEST['titulacion'];
$Correo = $_REQUEST['correo'];
$Password = $_REQUEST['password'];


try {
    $sentencia = $conexion->prepare("UPDATE voluntario SET Nombre=:Nombre,Titulacion=:Titulacion,Password=:Password,Correo=:Correo
        WHERE Correo =:Correo;");
    $resultado = $sentencia->execute([
        ":Nombre" => $Nombre, ":Titulacion" => $Titulacion, ":Password" => $Password, ":Correo" => $Correo
    ]);
    $operacion['alta'] = true;

    unset($_SESSION['usuario']);

    $sql2 = "SELECT * FROM voluntario WHERE Correo=:Correo";
    $consulta2 = $conexion->prepare($sql2);
    $consulta2->execute([":Correo" => $Correo]);
    $voluntario = $consulta2->fetch(PDO::FETCH_OBJ);
    $_SESSION['usuario'] = $voluntario;
    
} catch (PDOException $e) {
    $operacion['alta'] = false;
}
echo json_encode($operacion);
