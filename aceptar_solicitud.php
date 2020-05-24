<?php
include_once "conectar.php";
$conexion = conectar();
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
}
$dependiente = $_SESSION['usuario'];
$nombre = $dependiente->Nombre;


$id_dependiente = $_REQUEST['dependiente'];
$id_voluntario = $_REQUEST['voluntario'];

try {
    $sql = "INSERT INTO parejas (id_dependientes,id_voluntario) value 
    (:id_dependientes,:id_voluntario)";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([
        ":id_dependientes" => $id_dependiente,
        ":id_voluntario" => $id_voluntario
    ]);
} catch (PDOException $e) {
}

try {
    $sentencia = $conexion->prepare("UPDATE dependiente SET voluntario=:voluntario
        WHERE Numero_socio=:Numero_socio;");
    $resultado = $sentencia->execute([
        ":voluntario" => $id_voluntario, ":Numero_socio" => $id_dependiente
    ]);
} catch (PDOException $e) {
}

try {
    $sentencia = $conexion->prepare("DELETE FROM solicitudes WHERE dependiente=:dependiente;");
    $resultado = $sentencia->execute([
        ":dependiente" => $id_dependiente
    ]);
} catch (PDOException $e) {
}

try {
    $sentencia = $conexion->prepare("DELETE FROM solicitudes WHERE voluntario=:voluntario;");
    $resultado = $sentencia->execute([
        ":voluntario" => $id_voluntario
    ]);
} catch (PDOException $e) {
}

header("Location:solicitar_dependientes.php");
