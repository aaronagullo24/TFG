<?php
session_start();
include_once "conectar.php";
$conexion = conectar();
$id_dependiente = $_REQUEST['dependiente'];
$id_voluntario = $_REQUEST['voluntario'];

$sentencia = $conexion->prepare("DELETE FROM chat WHERE id=:id OR id=:id_v");
$resultado = $sentencia->execute(["id" => $id_dependiente,":id_v"=>$id_voluntario]);

header("location:chat_admin.php?vaciado=vaciado");