<?php
session_start();
include_once "conectar.php";
$conexion = conectar();

$fecha = $_REQUEST['fecha'];
$evento = $_REQUEST['evento'];
$inicio = $_REQUEST['inicio'];
$finalizacion = $_REQUEST['finalizacion'];
$final = $_REQUEST['final'];
$color = $_REQUEST['color'];
$detalles = $_REQUEST['detalles'];

$dependiente = $_REQUEST['dependiente'];


$inicio = $fecha . " " . $inicio;
$finalizacion = $final . " " . $finalizacion;


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
    $sql = "INSERT INTO calendarios (id,title,start,end,editable,id_voluntario,id_dependiente,color,Detalles) value 
    (:id,:title,:start,:end,:editable,:id_voluntario,:id_dependiente,:color,:Detalles)";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([
        ":id" => null, ":title" => $evento, ":start" => $inicio,
        ":end" => $finalizacion,  ":editable" => 11, ":id_voluntario" => $voluntario->id_voluntario,
        ":id_dependiente" => $dependiente, ":color" => $color, ":Detalles" => $detalles
    ]);
} catch (PDOException $e) {
}

///correo voluntario
ini_set('display_errors', 1);
error_reporting(E_ALL);
$from = "admin@oldver.es";
$to = $voluntario1->Correo;
$subject = "Evento próximo";
$message = "El próximo día ".$fecha." tienes ".$evento. ", ¡no lo olvides!";
$headers = "From:" . $from;
mail($to, $subject, $message, $headers);

//correo dependientes
ini_set('display_errors', 1);
error_reporting(E_ALL);
$from = "admin@oldver.es";
$to = $dependiente2->Correo;
$subject = "Evento próximo";
$message = "El próximo día ".$fecha." tiene ".$evento. ", ¡recuérdelo!";
$headers = "From:" . $from;
mail($to, $subject, $message, $headers);


header("location:calendario_dependiente.php");
