<?php
include_once "conectar.php";
$conexion = conectar();
session_start();
$dependiente = $_SESSION['usuario'];
$nombre = $dependiente->Nombre;


$dependiente=$_REQUEST['dependiente'];
$voluntario=$_REQUEST['voluntario'];

$sentencia = $conexion -> prepare("DELETE FROM solicitudes WHERE voluntario =:voluntario AND dependiente=:dependiente");
$resultado = $sentencia->execute([":voluntario"=>$voluntario,":dependiente"=>$dependiente]);
if($resultado===true) header("Location: solicitar_dependientes.php");
else header("Location: solicitar_dependientes.php");
