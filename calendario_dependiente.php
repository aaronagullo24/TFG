<?php
session_start();
if (!isset($_SESSION['dependiente'])) {
    header("Location: login.php");
}
include_once("funciones.php");
$dependiente = $_SESSION['dependiente'];
$nombre = $dependiente->Nombre;
include_once "conectar.php";
$conexion = conectar();

$sql = "SELECT * FROM calendarios WHERE id_dependiente=:id_dependiente";
$consulta = $conexion->prepare($sql);
$consulta->execute([':id_dependiente' => $dependiente->Numero_socio]);


?>

<!DOCTYPE html>
<html lang="es">

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
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay,',

            },
            events: [
                <?php
                while ($calendario = $consulta->fetch(PDO::FETCH_OBJ)) {
                ?> {

                        id: "<?php echo $calendario->id ?>",
                        title: "<?php echo $calendario->title ?>",
                        start: "<?php echo $calendario->start ?>",
                        end: "<?php echo $calendario->end ?>",
                        color: " <?php echo $calendario->color ?>",
                        editable: "<?php echo $calendario->editable ?>",
                        description: "<?php echo $calendario->Detalles ?>"

                    },
                <?php
                }
                ?>
            ],
            dayClick: function(date, event) {
                $("#exampleModal").modal("show");
                $("#fecha").val(date.format());
                $("#final").val(date.format());
            },

            eventClick: function(info) {
                console.log(info)
                $("#update").modal("show");
                $("#evento1").val(info.title);
                $("#fecha1").val(info.start.format());
                if (info.end != null) {
                    $("#finalizacion1").val(info.end.format());
                }
                $("#color1").val(info.color);
                $("#detalles1").val(info.description);
                $("#id").val(info.id);
                $("#id1").val(info.id);
            },

        })
    });
</script>

</head>

<body background="resources/calendario.jpg">

    <?php
    dependiente($dependiente);
    ?>
    <?php
    $sql = "SELECT * FROM parejas WHERE id_dependientes=:id_dependientes";
    $consulta = $conexion->prepare($sql);
    $consulta->execute(["id_dependientes" => $dependiente->Numero_socio]);
    $consulta_dependientes = $consulta->fetch(PDO::FETCH_OBJ);

    if ($consulta->rowCount() == 0) {
    ?>
        <div class="alert alert-success mt-3 text-center">No tiene un voluntario para acceder al calendario. Se activará automáticamente cuando le sea asignado. </div>
    <?php
    } else {
    ?>

        <div class="row mt-1">
            <div class="col-md-3"></div>

            <div class="col-md-6" style="background-color: white; border: 5px solid black; ">
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
                        <form action="nuevo_evento_dependiente.php" method="POST">
                            <label for="">Fecha</label>
                            <input type="date" id="fecha" name="fecha" />
                            <br>
                            <label for="">Evento</label>
                            <input type="text" id="evento" name="evento">
                            <br>
                            <label for="">Fecha de finalizacion</label>
                            <input type="date" required id="final" name="final" />
                            <br>
                            <label for="">Hora de inicio:</label>
                            <input type="time" id="inicio" name="inicio">
                            <br>
                            <label for="">Hora de finalizacion:</label>
                            <input type="time" id="finalizacion" name="finalizacion">
                            <br>
                            <label for="">Color del evento:</label>
                            <input type="color" id="color" name="color">
                            <BR>
                            <label for="">Detalles:</label>
                            <input type="text" id="detalles" name="detalles">

                            <input type="hidden" value="<?php echo $dependiente->Numero_socio ?>" name="dependiente" id="dependiente">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>


        <!-- Modal UPDATE -->
        <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="update" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="update">ACTUALIZAR: </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actualizar_evento_dependiente.php" method="POST">

                            <input type="hidden" id="fecha1" name="fecha1" />
                            <br>
                            <label for="">Evento</label>
                            <input type="text" id="evento1" name="evento1">


                            <input type="hidden" id="inicio1" name="inicio1">


                            <input type="hidden" id="finalizacion1" name="finalizacion1">
                            <br>
                            <label for="">Color del evento:</label>
                            <input type="color" id="color1" name="color1">
                            <br>
                            <label for="">Detalles:</label>
                            <input type="text" id="detalles1" name="detalles1">

                            <input type="hidden" name="id" id="id">
                            <input type="hidden" value="<?php echo $dependiente->Numero_socio ?>" name="dependiente" id="dependiente">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                        <form action="borrar_calendario_dependiente.php" method="POST">
                            <input type="hidden" value="<?php echo $dependiente->Numero_socio ?>" name="dependiente" id="dependiente">
                            <input type="hidden" name="id1" id="id1">
                            <button type="submit" class="btn btn-danger">Borrar</button>
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