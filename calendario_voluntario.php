<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
}
$voluntario = $_SESSION['usuario'];
$nombre = $voluntario->Nombre;
include_once "conectar.php";
$conexion = conectar();

$sql = "SELECT * FROM calendarios WHERE id_voluntario=:id_voluntario";
$consulta = $conexion->prepare($sql);
$consulta->execute([':id_voluntario' => $voluntario->Numero_socio]);


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
                id: 'calendar',
                locale: 'es',
                events: [
                    <?php
                    while ($calendario = $consulta->fetch(PDO::FETCH_OBJ)) {
                    ?> {

                            id: "<?php echo $calendario->id ?>",
                            title: "<?php echo $calendario->title ?>",
                            start: "<?php echo $calendario->start ?>",
                            end: "<?php echo $calendario->end ?>",
                            color: " <?php echo $calendario->color ?>",
                            editable: "<?php echo $calendario->editable ?>"

                        },
                    <?php
                    }
                    ?>
                ],
                dayClick: function(date, event) {
                    $("#exampleModal").modal("show");
                    $("#fecha").val(date.format());
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
                <a class="nav-item nav-link " href="calendario_voluntario.php">Calendario</a>
                <a class="nav-item nav-link " href="chat_dependiente.php">chat</a>
            </div>
            <div class="d-flex flex-row justify-content-center">
                <a href="login.php" class="btn btn-outline-danger">Cerrar sesion</a>
            </div>
        </div>
    </nav>
    <?php
    $sql = "SELECT * FROM parejas WHERE id_voluntario=:id_voluntario";
    $consulta = $conexion->prepare($sql);
    $consulta->execute(["id_voluntario" => $voluntario->Numero_socio]);
    $consulta_dependientes = $consulta->fetch(PDO::FETCH_OBJ);

    if ($consulta->rowCount() == 0) {
    ?>
        <div class="alert alert-success mt-3">El calendario se activara automaticamente cuando tenga un dependiente al que cuidar</div>
    <?php
    } else {
    ?>
        <br>
        <div class="row">
            <div class="col-md-3"></div>

            <div class="col-md-6">
                <div id="calendar">

                </div>
            </div>

            <div class="col-md-3"></div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Planes: </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="nuevo_evento.php" method="POST">
                            <label for="">Fecha</label>
                            <input type="text" id="fecha" name="fecha" />
                            <br>
                            <label for="">Evento</label>
                            <input type="text" id="evento" name="evento">
                            <br>
                            <label for="">Hora de inicio:</label>
                            <input type="time" id="inicio" name="inicio">
                            <br>
                            <label for="">Hora de finalizacion:</label>
                            <input type="time" id="finalizacion" name="finalizacion">
                            <br>
                            <label for="">Color del evento:</label>
                            <input type="color" id="color" name="color">

                            <input type="hidden" value="<?php echo $voluntario->Numero_socio ?>" name="voluntario" id="voluntario">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
    <?php } ?>
</body>

</html>