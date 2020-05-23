<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
}
include_once "funciones.php";
include_once "conectar.php";
$conexion = conectar();
$voluntario = $_SESSION['usuario'];
$nombre = $voluntario->Nombre;
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
            req.open('GET', 'chat_vo.php', true);
            req.send();
        }

        setInterval(function() {
            ajax();
        }, 1000);
    </script>




</head>

<body background="resources/chat.jpg" onload="ajax();">

    <?php
    voluntario($voluntario);
    ?>
    <br>

    <?php
    $sql = "SELECT * FROM parejas WHERE id_voluntario=:id_voluntario";
    $consulta = $conexion->prepare($sql);
    $consulta->execute(["id_voluntario" => $voluntario->Numero_socio]);
    $consulta_dependientes = $consulta->fetch(PDO::FETCH_OBJ);

    if ($consulta->rowCount() == 0) {
    ?>
        <div class="alert alert-success text-center">
            El chat se activara automaticamente cuando tenga un dependiente al que cuidar
        </div>
    <?php
    } else {
    ?>
        <div class="container">
            <div id="caja-chat" style="border: solid 3px black; background-color: #A4F4AA">
                <div id="chat" style="background-color: #A4F4AA;">

                </div>
            </div>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-10 mr-0">
                        <form method="POST" action="chat_dependiente.php">
                            <input type="hidden" name="id" id="id" value="<?php echo $voluntario->Numero_socio ?>">
                            <input type="hidden" name="nombre" id="nombre" value="<?php echo $voluntario->Nombre ?>">
                            <textarea name="mensaje" placeholder="Ingresa tu mensaje" class="form-control"></textarea>
                    </div>
                    <div class="col-2 ml-0">
                        <input style="float:right;" id="enviar" type="submit" name="enviar" class="btn btn-primary" value="Enviar">
                        </form>
                    </div>
                </div>


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
