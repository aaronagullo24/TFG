<?php
session_start();
include_once "conectar.php";
$conexion = conectar();

$fecha=$_REQUEST['fecha'];
$evento=$_REQUEST['evento'];
$inicio=$_REQUEST['inicio'];
$finalizacion=$_REQUEST['finalizacion'];
$color=$_REQUEST['color'];

$voluntario=$_REQUEST['voluntario'];

$inicio=$fecha." ".$inicio;
$finalizacion=$fecha." ".$finalizacion;


$sql = "SELECT * FROM parejas WHERE id_voluntario=:id_voluntario";
$consulta = $conexion->prepare($sql);
$consulta->execute([':id_voluntario'=>$voluntario]);
$dependiente = $consulta->fetch(PDO::FETCH_OBJ);

try {
    $sql = "INSERT INTO calendarios (id,title,start,end,editable,id_voluntario,id_dependiente,color) value 
    (:id,:title,:start,:end,:editable,:id_voluntario,:id_dependiente,:color)";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([
        ":id" => null, ":title" => $evento, ":start" => $inicio,
        ":end" => $finalizacion,  ":editable" => 11, ":id_voluntario" => $voluntario,
        ":id_dependiente" => $dependiente->id_dependientes,":color"=>$color
    ]);
  
} catch (PDOException $e) {
    
}

header("location:calendario_voluntario.php");
