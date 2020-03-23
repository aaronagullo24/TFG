<?php
include_once "conectar.php";
$conexion=conectar();
$Nick=$_REQUEST['Nick'];

$encontrado=[];

$sql="SELECT * FROM voluntario WHERE Nick=:Nick";
$consulta=$conexion->prepare($sql);
$consulta->execute(["Nick"=>$Nick]);
if($consulta->rowCount()<1) $encontrado['encontrado']=false;
else $encontrado['encontrado']=true;
echo json_encode($encontrado);
?>