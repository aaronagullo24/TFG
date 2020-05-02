<?php
session_start();
include_once "conectar.php";
$conexion = conectar();

$id=$_REQUEST['id1'];

$sentencia = $conexion->prepare("DELETE FROM calendarios WHERE id=:id");
$resultado = $sentencia->execute(["id" => $id]);

header("location:calendario_dependiente.php");