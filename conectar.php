<?php
define("PASSWORD", "10052007Sh$");
define("USUARIO", "dbu456650");
define("BB_DD", "dbs332813");
define("SERVIDOR", "db5000342437.hosting-data.io");

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