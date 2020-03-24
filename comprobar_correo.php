<?php
include_once "conectar.php";
$conexion=conectar();
$Correo=$_REQUEST['correo'];

$encontrado=[];

$sql="SELECT * FROM voluntario WHERE Correo=:Correo";
$consulta=$conexion->prepare($sql);
$consulta->execute(["Correo"=>$Correo]);
if($consulta->rowCount()<1) $encontrado['encontrado']=false;
else $encontrado['encontrado']=true;
echo json_encode($encontrado);
?>