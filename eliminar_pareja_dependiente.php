<?php
session_start();
include_once "conectar.php";
$conexion = conectar();
if (!isset($_SESSION['dependiente'])) {
    header("Location: login.php");
}
$id_dependiente = $_REQUEST['dependiente'];
$id_voluntario = $_REQUEST['voluntario'];

$sentencia = $conexion->prepare("DELETE FROM parejas WHERE id_dependientes=:id_dependientes AND id_voluntario=:id_voluntario");
$resultado = $sentencia->execute(["id_dependientes" => $id_dependiente, "id_voluntario" => $id_voluntario]);

$sentencia = $conexion->prepare("DELETE FROM chat WHERE id=:id OR id=:id_v");
$resultado = $sentencia->execute(["id" => $id_dependiente, ":id_v" => $id_voluntario]);

try {
    $sentencia = $conexion->prepare("UPDATE dependiente SET voluntario=:voluntario WHERE Numero_socio=:Numero_socio");
    $resultado = $sentencia->execute([
        ":voluntario" => NULL,":Numero_socio"=>$id_dependiente
    ]);
} catch (PDOException $e) {
    $operacion['alta'] = false;
}
header("location:http://oldver.es/perfil_pareja_dependiente.php");