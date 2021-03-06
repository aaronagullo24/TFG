<?php
session_start();
include_once "conectar.php";
$conexion = conectar();
$voluntario = $_SESSION['usuario'];


$sql1 = "SELECT * FROM parejas WHERE id_voluntario=:id_voluntario;";
$consulta1 = $conexion->prepare($sql1);
$consulta1->execute([":id_voluntario" => $voluntario->Numero_socio]);
$id = $consulta1->fetch(PDO::FETCH_OBJ);

$sql = "SELECT * FROM chat WHERE id=:id_dependiente OR id=:id_voluntario 
ORDER BY fecha ASC;";
$consulta = $conexion->prepare($sql);
$consulta->execute([":id_dependiente" => $id->id_dependientes, ":id_voluntario" => $id->id_voluntario]);

$sentencia = $conexion->prepare("UPDATE chat SET Leido=:Leido WHERE id =:id;");
$resultado = $sentencia->execute([":Leido" => "leido", ":id" => $id->id_dependientes]);

while ($voluntario1 = $consulta->fetch(PDO::FETCH_OBJ)) {

?>
    <div id="datos-chat" style="border:1px solid blue;background-color:white; word-wrap: break-word; scroll-behavior:smooth">
        <span style="color:#1c62c4;"><?php echo $voluntario1->Nombre ?></span>
        <span style="float:right;"><?php echo $voluntario1->fecha ?></span>
        <p style="color:#848484;"><?php echo $voluntario1->mensaje ?></p>    
    </div>
<?php } ?>