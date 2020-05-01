<?php
session_start();
include_once "conectar.php";
$conexion = conectar();

$id = $_REQUEST['id'];
$voluntario = $_REQUEST['voluntario'];
$dependiente = $_REQUEST['dependiente'];

$sentencia = $conexion->prepare("DELETE FROM calendarios WHERE  id=:id");
$resultado = $sentencia->execute([":id" => $id]);
if ($resultado === true) header("location:ver_calendario.php?dependiente=$dependiente?&voluntario=$voluntario");
