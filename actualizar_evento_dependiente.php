<?php
session_start();
include_once "conectar.php";
$conexion = conectar();

$fecha = $_REQUEST['fecha1'];
$evento = $_REQUEST['evento1'];
$inicio = $_REQUEST['fecha1'];
$finalizacion = $_REQUEST['finalizacion1'];
$color = $_REQUEST['color1'];
$Detalles = $_REQUEST['detalles1'];
$id = $_REQUEST['id'];

$dependiente = $_REQUEST['dependiente'];


$sql = "SELECT * FROM parejas WHERE id_dependientes=:id_dependientes";
$consulta = $conexion->prepare($sql);
$consulta->execute([':id_dependientes' => $dependiente]);
$voluntario = $consulta->fetch(PDO::FETCH_OBJ);


$sql2 = "SELECT * FROM dependiente WHERE Numero_socio=:Numero_socio";
$consulta2 = $conexion->prepare($sql2);
$consulta2->execute([':Numero_socio' => $dependiente]);
$dependiente2 = $consulta2->fetch(PDO::FETCH_OBJ);

$sql1 = "SELECT * FROM voluntario WHERE Numero_socio=:Numero_socio";
$consulta1 = $conexion->prepare($sql1);
$consulta1->execute([':Numero_socio' => $voluntario->id_voluntario]);
$voluntario1 = $consulta1->fetch(PDO::FETCH_OBJ);


try {
    $sentencia = $conexion->prepare("UPDATE calendarios SET title=:title,color=:color,Detalles=:Detalles
   WHERE id =:id;");
    $resultado = $sentencia->execute([":title" => $evento, ":color" => $color, ":Detalles" => $Detalles, ":id" => $id]);
} catch (PDOException $e) {
}

///correo voluntario
ini_set('display_errors', 1);
error_reporting(E_ALL);
$from = "admin@oldver.es";
$to = $voluntario1->Correo;
$subject = "Actualizacion de evento";
$message = "El evento ".$evento." a sido modificado, entre a su calendario para verlo";
$headers = "From:" . $from;
mail($to, $subject, $message, $headers);

//correo dependientes
ini_set('display_errors', 1);
error_reporting(E_ALL);
$from = "admin@oldver.es";
$to = $dependiente2->Correo;
$subject = "Actualizacion de evento";
$message = "El evento ".$evento." a sido modificado, entre a su calendario para verlo";
$headers = "From:" . $from;
mail($to, $subject, $message, $headers);

header("location:calendario_dependiente.php");
