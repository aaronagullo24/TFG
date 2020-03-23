<?php
define("PASSWORD", "");
define("USUARIO", "root");
define("BB_DD", "oldver");
define("SERVIDOR", "localhost");

function conectar()
{
    $conexion = null;

    try {
        $opciones = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $conexion = new PDO('mysql:host=' . SERVIDOR . ';dbname=' . BB_DD, USUARIO, PASSWORD, $opciones);
    } catch (Exception $e) {
        echo "Ocurrió algo con la base de datos: " . $e->getMessage();
    }
    return $conexion;
}