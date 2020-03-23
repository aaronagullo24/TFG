<?php
include_once "conectar.php";
$conexion=conectar();
$dni=$_REQUEST['DNI'];

$encontrado=[];

$sql="SELECT * FROM voluntario WHERE DNI=:DNI";
$consulta=$conexion->prepare($sql);
$consulta->execute(["DNI"=>$dni]);
if($consulta->rowCount()<1) $encontrado['encontrado']=false;
else $encontrado['encontrado']=true;
echo json_encode($encontrado);
?>