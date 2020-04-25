<?php
session_start();
include_once "conectar.php";
$conexion = conectar();

$sql = "SELECT * FROM calendarios";
$consulta = $conexion->prepare($sql);
$consulta->execute();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Oldver</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">

    <link rel='stylesheet' href="fullcalendar/fullcalendar.css" />
    <script src="fullcalendar/lib/jquery.min.js"></script>
    <script src="fullcalendar/lib/moment.min.js"></script>
    <script src="fullcalendar/fullcalendar.js"></script>
    <script src="fullcalendar/locale/es.js"></script>

    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
               locale:'es',
                events: [
                    <?php
                    while ($calendario = $consulta->fetch(PDO::FETCH_OBJ)) {
                    ?> {

                            id: "<?php echo $calendario->id ?>",
                            title: "<?php echo $calendario->title ?>",
                            start: "<?php echo $calendario->start ?>",
                            end: "<?php echo $calendario->end ?>",
                            url: "<?php echo $calendario->url ?>",
                            color: " <?php echo $calendario->color ?>",
                            editable: "<?php echo $calendario->editable ?>"

                        },
                    <?php
                    }
                    ?>
                ],
                dayClick:function(date,event){
                    alert(date.format());
                }
            })
        });
    </script>

</head>

<body>
    <!-- menú de navegación -->
    <nav class="navbar navbar-inverse bg-inverse navbar-toggleable-sm sticky-top">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="ver_perfil_voluntario.php">
            <img src="resources/logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo Bootstrap">
            <?php
            echo $nombre;
            ?>
            </p> </a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <div class="navbar-nav mr-auto ml-auto text-center">
                <a class="nav-item nav-link " href="solicitar_voluntario.php">Solicitar</a>
                <a class="nav-item nav-link" href="ver_perfil_voluntario.php">Perfil</a>
                <a class="nav-item nav-link " href="calendario.php">Calendario</a>
                <a class="nav-item nav-link " href="chat_dependiente.php">chat</a>
            </div>
            <div class="d-flex flex-row justify-content-center">

                <a href="login.php" class="btn btn-outline-danger">Cerrar sesion</a>
            </div>
        </div>
    </nav>

    <div class="container">
    <div id="calendar">

    </div>
    </div>


</body>

</html>