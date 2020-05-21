<?php
session_start();
include_once "conectar.php";
$conexion = conectar();

$fecha = $_REQUEST['fecha'];
$evento = $_REQUEST['evento'];
$inicio = $_REQUEST['inicio'];
$fin = $_REQUEST['fecha_fin'];
$finalizacion = $_REQUEST['finalizacion'];
$color = $_REQUEST['color'];
$detalles = $_REQUEST['Detalles'];

$voluntario = $_REQUEST['voluntario'];
$dependiente = $_REQUEST['dependiente'];

$inicio = $fecha . " " . $inicio;
$finalizacion = $fin . " " . $finalizacion;



try {
    $sql = "INSERT INTO calendarios (id,title,start,end,editable,id_voluntario,id_dependiente,color,Detalles) value 
    (:id,:title,:start,:end,:editable,:id_voluntario,:id_dependiente,:color,:Detalles)";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([
        ":id" => null, ":title" => $evento, ":start" => $inicio,
        ":end" => $finalizacion, ":editable" => 11, ":id_voluntario" => $voluntario,
        ":id_dependiente" => $dependiente, ":color" => $color, ":Detalles" => $detalles
    ]);
} catch (PDOException $e) {
}

$sql = "SELECT Correo FROM voluntario WHERE Numero_socio=:Numero_socio";
$consulta = $conexion->prepare($sql);
$consulta->execute([":Numero_socio" => $voluntario]);
$voluntario_correo = $consulta->fetch(PDO::FETCH_OBJ);

$sql1 = "SELECT Correo FROM dependiente WHERE Numero_socio=:Numero_socio";
$consulta1 = $conexion->prepare($sql1);
$consulta1->execute([":Numero_socio" => $dependiente]);
$dependiente_correo = $consulta1->fetch(PDO::FETCH_OBJ);

///correo voluntario
ini_set('display_errors', 1);
error_reporting(E_ALL);
$from = "admin@oldver.es";
$to = $voluntario_correo->Correo;
$subject = "Evento proximo";
$message = "El proximo dia ".$fecha." tiene ".$evento. ", recuerdelo";
$headers = "From:" . $from;
mail($to, $subject, $message, $headers);

//correo dependientes
ini_set('display_errors', 1);
error_reporting(E_ALL);
$from = "admin@oldver.es";
$to = $dependiente_correo->Correo;
$subject = "Evento proximo";
$message = "El proximo dia ".$fecha." tiene ".$evento. ", recuerdelo";
$headers = "From:" . $from;
mail($to, $subject, $message, $headers);

header("location:ver_calendario.php?dependiente=$dependiente?&voluntario=$voluntario");
