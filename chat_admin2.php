<?php
session_start();
include_once "conectar.php";
$conexion = conectar();
$id_dependiente = $_SESSION['id_dependiente'];
$id_voluntario = $_SESSION['id_voluntario'];




$sql = "SELECT * FROM chat WHERE id=:id_dependiente OR id=:id_voluntario 
ORDER BY fecha ASC;";
$consulta = $conexion->prepare($sql);
$consulta->execute([":id_dependiente" => $id_dependiente, ":id_voluntario" => $id_voluntario]);
while ($voluntario1 = $consulta->fetch(PDO::FETCH_OBJ)) {
    
?>
    <div id="datos-chat">
        <span style="color:#1c62c4;"><?php echo $voluntario1->Nombre ?></span>
        <span style="color:#848484;"><?php echo $voluntario1->mensaje ?></span>
        <a href="borrar_mensaje.php?id=<?php echo $voluntario1->id_chat ?>" class="btn btn-danger btn-xs ml-2" style="float:right;">borrar</a>
        <span style="float:right;"><?php echo $voluntario1->fecha?></span>
    </div>
<?php } ?>