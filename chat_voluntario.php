<?php
session_start();
if (!isset($_SESSION['dependiente'])) {
    header("Location: login.php");
}
include_once "conectar.php";
$conexion = conectar();
$dependiente = $_SESSION['dependiente'];
$nombre = $dependiente->Nombre;
?>

<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Oldver</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/AjaxCode.js"></script>
    <script src="js/mi_libreriaAjax.js"></script>
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <script type="text/javascript">
        function ajax() {
            var req = new XMLHttpRequest();

            req.onreadystatechange = function() {
                if (req.readyState == 4 && req.status == 200) {
                    document.getElementById('chat').innerHTML = req.responseText;
                }
            }
            req.open('GET', 'chat.php', true);
            req.send();
        }

        setInterval(function() {
            ajax();
        }, 1000);
    </script>
</head>

<body style="background-color: aquamarine;" onload="ajax();">

    <!-- menú de navegación -->
    <nav class="navbar navbar-inverse bg-inverse navbar-toggleable-sm sticky-top">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="inicio_dependientes.php">
            <img src="resources/logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo Bootstrap">
            <?= $dependiente->Nombre ?> </a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <div class="navbar-nav mr-auto ml-auto text-center">
                <a class="nav-item nav-link " href="solicitar_dependientes.php">Solicitar</a>
                <a class="nav-item nav-link" href="ver_perfil_dependientes.php">Perfil</a>
                <a class="nav-item nav-link " href="calendario_dependiente.php">Calendario</a>
                <a class="nav-item nav-link " href="chat_voluntario.php">Chat</a>
            </div>
            <div class="d-flex flex-row justify-content-center">
                <a href="login.php" class="btn btn-outline-danger">Cerrar sesion</a>
            </div>
        </div>
    </nav>
    <br>

    <?php
    $sql = "SELECT * FROM parejas WHERE id_dependientes=:id_dependientes";
    $consulta = $conexion->prepare($sql);
    $consulta->execute(["id_dependientes" => $dependiente->Numero_socio]);
    $consulta_dependientes = $consulta->fetch(PDO::FETCH_OBJ);

    if ($consulta->rowCount() == 0) {
    ?>
        <div class="alert alert-success">¡usted aun no tiene un ayudante asignado, vaya a la pestaña de solicitudes!</div>
    <?php
    } else {
    ?>
        <div class="container">
            <div id="caja-chat">
                <div id="chat">

                </div>
            </div>
            <br>
            <form method="POST" action="chat_voluntario.php">

                <!-- <input type="text" name="nombre" placeholder="nombre"> -->
                <input type="hidden" name="id" id="id" value="<?php echo $dependiente->Numero_socio ?>">
                <input type="hidden" name="nombre" id="nombre" value="<?php echo $dependiente->Nombre ?>">
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
    <?php } ?>
</body>

<?php
