<?php
session_start();
include_once "conectar.php";
$conexion = conectar();

$fecha=$_REQUEST['fecha1'];
$evento=$_REQUEST['evento1'];
$inicio=$_REQUEST['inicio1'];
$finalizacion=$_REQUEST['finalizacion1'];
$color=$_REQUEST['color1'];
$Detalles=$_REQUEST['detalles1'];
$id=$_REQUEST['id'];

$inicio=$fecha." ".$inicio;
$finalizacion=$fecha." ".$finalizacion;

try {
    $sentencia = $conexion->prepare("UPDATE calendarios SET title=:title,start=:start,end=:end,color=:color,Detalles=:Detalles
   WHERE id =:id;");
    $resultado = $sentencia->execute([":title" => $evento, ":start"=>$inicio,":end"=>$finalizacion,
    ":color"=>$color, ":Detalles"=>$Detalles,":id"=>$id]);
  
} catch (PDOException $e) {
    
}

header("location:calendario_dependiente.php");
