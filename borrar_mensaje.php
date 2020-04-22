<?php
session_start();
include_once "conectar.php";
$conexion = conectar();
$id_dependiente = $_SESSION['id_dependiente'];
$id_voluntario = $_SESSION['id_voluntario'];

$id=$_REQUEST['id'];



$sentencia = $conexion->prepare("DELETE FROM chat WHERE id_chat=:id_chat");
$resultado = $sentencia->execute(["id_chat" => $id]);

header("location:ver_chat_admin.php?borrado=borrar");