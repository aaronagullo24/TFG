<?php
session_start();
include_once "conectar.php";
$conexion = conectar();

$fecha = $_REQUEST['fecha1'];
$evento = $_REQUEST['evento1'];
$inicio = $_REQUEST['inicio1'];
$finalizacion = $_REQUEST['finalizacion1'];
$color = $_REQUEST['color1'];
$Detalles = $_REQUEST['detalles1'];
$id = $_REQUEST['id'];



try {
    $sentencia = $conexion->prepare("UPDATE calendarios SET title=:title,color=:color,Detalles=:Detalles
   WHERE id =:id;");
    $resultado = $sentencia->execute([":title" => $evento, ":color" => $color, ":Detalles" => $Detalles, ":id" => $id]);
} catch (PDOException $e) {
}

header("location:calendario_voluntario.php");
