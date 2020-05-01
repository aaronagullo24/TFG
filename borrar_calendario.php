<?php
session_start();
include_once "conectar.php";
$conexion = conectar();
$id=$_REQUEST['id'];

$sentencia = $conexion->prepare("DELETE FROM calendarios WHERE id=:id");
$resultado = $sentencia->execute(["id" => $id]);

