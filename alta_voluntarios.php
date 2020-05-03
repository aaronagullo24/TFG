<?php
include_once "conectar.php";
$conexion = conectar();
$operacion = [];


$Nombre =  $_REQUEST['Nombre'];
$Correo = $_REQUEST['correo'];
$Password = $_REQUEST['password'];
$titulacion = $_REQUEST['titulacion'];


try {
    $sql = "INSERT INTO voluntario (Numero_socio,Nombre,Correo,Titulacion,Password) value 
    (:Numero_socio,:Nombre,:Correo,:Titulacion,:Password)";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([
        ":Numero_socio" => null,
        ":Nombre" => $Nombre,
        ":Correo" => $Correo,
        ":Titulacion" => $titulacion,
        ":Password" => $Password
    ]);
    
    $operacion['alta'] = true;

    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $from = "admin@oldver.es";
    $to = $Correo;
    $subject = "Dado de alta correctamente";
    $message = "Muchas gracias por darse de alta en nuestro servicio de voluntarios de oldver para ayudar a la gente que lo necesita,
    ya puede entrar a su perfil. 
    Muchas gracias.";
    $headers = "From:" . $from;
    mail($to, $subject, $message, $headers);
    
} catch (PDOException $e) {
    $operacion['alta'] = false;
}

echo json_encode($operacion);
