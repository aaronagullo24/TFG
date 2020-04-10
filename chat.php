<?php
session_start();
include_once "conectar.php";
$conexion = conectar();
$dependiente = $_SESSION['dependiente'];
$nombre = $dependiente->Nombre;


$sql = "SELECT * FROM chat ORDER BY id desc;";
$consulta = $conexion->prepare($sql);
$consulta->execute();
while ($voluntario1 = $consulta->fetch(PDO::FETCH_OBJ)) {

?>
    <div id="datos-chat">
        <span style="color:#1c62c4;"><?php echo $voluntario1->Nombre ?></span>
        <span style="color:#848484;"><?php echo $voluntario1->mensaje ?></span>
        <span style="float:right;">10:04</span>
    </div>
<?php } ?>