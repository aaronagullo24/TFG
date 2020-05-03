<?php
include_once "conectar.php";
$conexion = conectar();
$operacion = [];


$Nombre =  $_REQUEST['Nombre'];
$Provincia = $_REQUEST['provinciaList'];
$Localidad = $_REQUEST['localidadList'];
$Fecha_nacimiento = $_REQUEST['fecha_nacimiento'];
$Correo = $_REQUEST['correo'];
$Necesidad = $_REQUEST['necesidad'];
$Password = $_REQUEST['password'];

$xml = simplexml_load_file('provinciasypoblaciones.xml');
$result = $xml->xpath("/lista/provincia/nombre | /lista/provincia/@id");

for ($i = 0; $i < count($result); $i += 2) {
    $e = $i + 1;
    if ($result[$i] == $Provincia) {
        $Provincia = UTF8_DECODE($result[$e]);
    }
}

try {
    $sql = "INSERT INTO dependiente (Numero_socio,Nombre,Provincia,Localidad,Fecha_nacimiento,Correo,Necesidad,Password) value 
    (:Numero_socio,:Nombre,:Provincia,:Localidad,:Fecha_nacimiento,:Correo,:Necesidad,:Password)";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([
        ":Numero_socio" => null, ":Provincia" => $Provincia, ":Localidad" => $Localidad,
        ":Correo" => $Correo, ":Necesidad" => $Necesidad, ":Nombre" => $Nombre, ":Fecha_nacimiento" => $Fecha_nacimiento,
        ":Password" => $Password
    ]);
    $operacion['alta'] = true;
    echo json_encode($operacion);

    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "admin@oldver.es";
    $to = $Correo;
    $subject = "Dado de alta correctamente";
    $message = "Muchas gracias por darse de alta en nuestra plataforma, a partir de este momento recibirá ayuda de nuestros voluntarios
    Muchas Gracias, esperamos ayudarle mucho";
    $headers = "From:" . $from;
    mail($to,$subject,$message, $headers);

    $operacion['alta'] = true;
} catch (PDOException $e) {
    $operacion['alta'] = false;
    echo json_encode($operacion);
}

echo json_encode($operacion);
