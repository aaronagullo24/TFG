<?php
session_start();
include_once "conectar.php";
$conexion = conectar();

$id = $_REQUEST['id1'];

$voluntario = $_REQUEST['voluntario'];
$evento = $_REQUEST['evento1'];

$sql = "SELECT * FROM calendarios WHERE id=:id";
$consulta = $conexion->prepare($sql);
$consulta->execute([':id' => $id]);
$calendario = $consulta->fetch(PDO::FETCH_OBJ);

$sql = "SELECT * FROM parejas WHERE id_voluntario=:id_voluntario";
$consulta = $conexion->prepare($sql);
$consulta->execute([':id_voluntario' => $voluntario]);
$dependiente = $consulta->fetch(PDO::FETCH_OBJ);



$sql2 = "SELECT * FROM dependiente WHERE Numero_socio=:Numero_socio";
$consulta2 = $conexion->prepare($sql2);
$consulta2->execute([':Numero_socio' => $dependiente->id_dependientes]);
$dependiente2 = $consulta2->fetch(PDO::FETCH_OBJ);



$sql1 = "SELECT * FROM voluntario WHERE Numero_socio=:Numero_socio";
$consulta1 = $conexion->prepare($sql1);
$consulta1->execute([':Numero_socio' => $voluntario]);
$voluntario1 = $consulta1->fetch(PDO::FETCH_OBJ);


$sentencia = $conexion->prepare("DELETE FROM calendarios WHERE id=:id");
$resultado = $sentencia->execute(["id" => $id]);


///correo voluntario
ini_set('display_errors', 1);
error_reporting(E_ALL);
$from = "admin@oldver.es";
$to = $voluntario1->Correo;
$subject = "Evento Eliminado";
$message = "El evento " . $calendario->title . " a sido eliminado";
$headers = "From:" . $from;
mail($to, $subject, $message, $headers);

//correo dependientes
ini_set('display_errors', 1);
error_reporting(E_ALL);
$from = "admin@oldver.es";
$to = $dependiente2->Correo;
$subject = "Evento Eliminado";
$message = "El evento " . $calendario->title . " a sido eliminado";
$headers = "From:" . $from;
mail($to, $subject, $message, $headers);
header("location:calendario_voluntario.php");
