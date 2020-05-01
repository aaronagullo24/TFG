<?php
session_start();
if (!isset($_SESSION['administrador'])) {
    header("Location: login.php");
}
$administrador = $_SESSION['administrador'];
include_once "conectar.php";
include_once "cabecera.php";
$voluntario = $_REQUEST['voluntario'];
$dependiente = $_REQUEST['dependiente'];
$conexion = conectar();
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
    <script src="js/buscar.js"></script>
</head>


<body style="background-color: aquamarine;">
    <?php
    administrador($administrador);
    ?>
    <input class="form-control col-md-3 light-table-filter" data-table="order-table" type="text" placeholder="buscar..">
    <br>
    <br>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Nuevo Evento
    </button>
    <br>
    <br>
    <table class="table table-hover order-table" id="tabla">
        <thead class="thead-dark">
            <tr>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Titulo</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Fecha inicio</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Fecha Final</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Color</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Detalles</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php


            $sql = "SELECT * FROM calendarios where id_voluntario=:id_voluntario AND id_dependiente=:id_dependiente";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([":id_voluntario" => $voluntario, ":id_dependiente" => $dependiente]);

            while ($calendario = $consulta->fetch(PDO::FETCH_OBJ)) {
                $inicio = new DateTime($calendario->start);
                $final = new DateTime($calendario->end);
            ?>

                <tr>
                    <td><?php echo $calendario->title ?></td>
                    <td><?php echo $inicio->format('d-m-Y H:i:s') ?></td>
                    <td><?php echo $final->format('d-m-Y H:i:s') ?></td>
                    <td><?php echo $calendario->color ?></td>
                    <td><?php echo $calendario->Detalles ?></td>
                    <td>
                        <form action="eliminar_calendario.php" method="post">
                            <input type="hidden" name="voluntario" value="<?php echo $voluntario ?>">
                            <input type="hidden" name="dependiente" value="<?php echo $dependiente ?>">
                            <input type="hidden" name="id" value="<?php echo $calendario->id ?>">
                            <input type="submit" class="btn btn-danger" value="Eliminar">
                        </form>
                    </td>
                <?php } ?>
                </tr>
        </tbody>
    </table>

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
                    <form action="nuevo_evento_admin.php" method="POST">
                        <label for="">Fecha Inicio</label>
                        <input type="date" id="fecha" name="fecha" />
                        <br>
                        <label for="">Fecha Fin</label>
                        <input type="date" id="fech_fin" name="fecha_fin" />
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
                        <br>
                        <label for="">Detalles:</label>
                        <br>
                        <textarea id="Detalles" name="Detalles"></textarea>

                        <input type="hidden" name="voluntario" value="<?php echo $voluntario ?>">
                        <input type="hidden" name="dependiente" value="<?php echo $dependiente ?>">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>