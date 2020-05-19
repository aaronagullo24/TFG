<?php
session_start();
if (!isset($_SESSION['administrador'])) {
    header("Location: login.php");
}
$administrador = $_SESSION['administrador'];
include_once "conectar.php";
$conexion = conectar();
$id_dependiente = $_REQUEST['dependiente'];
$id_voluntario = $_REQUEST['voluntario'];

if (!isset($_SESSION['id_dependiente'])) {
    $_SESSION['id_dependiente'] = $id_dependiente;
}
if (!isset($_SESSION['id_voluntario'])) {
    $_SESSION['id_voluntario'] = $id_voluntario;
}
include_once "cabecera.php";
$id_dependiente = $_SESSION['id_dependiente'];

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Oldver</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


    <link rel="stylesheet" type="text/css" href="estilo.css">
    <script type="text/javascript">
        function ajax() {
            var req = new XMLHttpRequest();
            req.onreadystatechange = function() {
                if (req.readyState == 4 && req.status == 200) {
                    document.getElementById('chat').innerHTML = req.responseText;
                }
            }
            req.open('GET', 'chat_admin2.php', true);
            req.send();
        }

        setInterval(function() {
            ajax();
        }, 1000);
    </script>
</head>

<body style="background-color: aquamarine;">
    <?php
    session_start();
    if (!isset($_SESSION['administrador'])) {
        header("Location: login.php");
    }
    $administrador = $_SESSION['administrador'];
    administrador($administrador);
    ?>
    <?php
    if (isset($_REQUEST['borrado'])) {
    ?>
        <div class="alert alert-success">Borrado con exito</div>

    <?php
        unset($_REQUEST['borrado']);
    }
    ?>

    <div class="container">
        <div id="caja-chat">
            <div id="chat">

            </div>
        </div>
        <br>

        <form method="POST" action="ver_chat_admin.php">
            <input type="hidden" name="id" id="id" value="<?php echo $id_dependiente ?>">
            <input type="hidden" name="nombre" id="nombre" value="<?php echo $administrador->correo ?>">
            <textarea name="mensaje" placeholder="Ingresa tu mensaje" class="form-control"></textarea>
            <input style="float:right;" id="enviar" type="submit" name="enviar" class="btn btn-success" value="Enviar">
        </form>
        <?php

        if (isset($_REQUEST['enviar'])) {
            $nombre = $_REQUEST['nombre'];
            $id = $_REQUEST['id'];
            $mensaje = $_REQUEST['mensaje'];

            try {
                $sql = "INSERT INTO chat (id,Nombre,mensaje) value (:id,:Nombre,:mensaje)";
                $consulta = $conexion->prepare($sql);
                $consulta->execute([
                    ":id" => $id, ":Nombre" => $nombre, ":mensaje" => $mensaje
                ]);
            } catch (PDOException $e) {
            }
        }
        ?>

    </div>

</body>