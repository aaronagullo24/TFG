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

header("location:ver_calendario.php?dependiente=$dependiente?&voluntario=$voluntario");
