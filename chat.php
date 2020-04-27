<?php
session_start();
include_once "conectar.php";
$conexion = conectar();
$dependiente = $_SESSION['dependiente'];
$nombre = $dependiente->Nombre;


$sql1 = "SELECT * FROM parejas WHERE id_dependientes=:id_dependientes;";
$consulta1 = $conexion->prepare($sql1);
$consulta1->execute([":id_dependientes" => $dependiente->Numero_socio]);
$id = $consulta1->fetch(PDO::FETCH_OBJ);

$sql = "SELECT * FROM chat WHERE id=:id_dependiente OR id=:id_voluntario 
ORDER BY fecha ASC;";
$consulta = $conexion->prepare($sql);
$consulta->execute([":id_dependiente" => $dependiente->Numero_socio, ":id_voluntario" => $id->id_voluntario]);
while ($voluntario1 = $consulta->fetch(PDO::FETCH_OBJ)) {

?>
    <div id="datos-chat" >
        <span style="color:#1c62c4;"><?php echo $voluntario1->Nombre ?></span>
        <span style="color:#848484;"><?php echo $voluntario1->mensaje ?></span>
        <span style="float:right;"><?php echo $voluntario1->fecha ?></span>
    </div>
<?php } ?>