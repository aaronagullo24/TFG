<?php
session_start();
if (!isset($_SESSION['administrador'])) {
    header("Location: login.php");
}
$administrador = $_SESSION['administrador'];
if (isset($_REQUEST['boton'])) {
    include_once "conectar.php";
$conexion = conectar();
    
    $dependiente = $_REQUEST['dependientes'];
    $voluntario = $_REQUEST['voluntarios'];

    try {
        $sql = "INSERT INTO parejas (id_dependientes,id_voluntario) value 
        (:id_dependientes,:id_voluntario)";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([
            ":id_dependientes" => $dependiente,
            ":id_voluntario" => $voluntario
        ]);
    } catch (PDOException $e) {
    }
    
    try {
        $sentencia = $conexion->prepare("UPDATE dependiente SET voluntario=:voluntario
            WHERE Numero_socio=:Numero_socio;");
        $resultado = $sentencia->execute([
            ":voluntario" => $voluntario, ":Numero_socio" => $dependiente
        ]);
    } catch (PDOException $e) {
    }
    
    header("Location:crear_pareja.php?bien=bien");
    
}
