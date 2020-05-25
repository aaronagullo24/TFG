<?php
include_once "conectar.php";
$conexion = conectar();
session_start();
if (!isset($_SESSION['dependiente'])) {
    header("Location: login.php");
}
include_once("funciones.php");
$dependiente = $_SESSION['dependiente'];
$nombre = $dependiente->Nombre;
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
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/mi_libreriaAjax.js"></script>
    <script src="js/AjaxCode.js"></script>
    <script src="js/buscar.js"></script>
</head>

<body style="background-color: #4FD53C;">

    <?php
    dependiente($dependiente);
    ?>

    <section class="container my-0 py-4">
        <h3 class="text-uppercase text-center mb-4">Solicitudes</h3>
        <p class="lead text-center mb-5"> Peticiones de voluntarios.  </p>

    </section>
    <?php
    $sql = "SELECT * FROM parejas WHERE id_dependientes=:id_dependientes";
    $consulta = $conexion->prepare($sql);
    $consulta->execute(["id_dependientes" => $dependiente->Numero_socio]);
    $consulta_dependientes = $consulta->fetch(PDO::FETCH_OBJ);

    if ($consulta->rowCount() == 1) {
    ?>

        <div class="alert alert-success mt-3 text-center">¡Tiene un voluntario asignado, enhorabuena!</div>
    <?php
    } else {
    ?>
        <input class="form-control col-md-3 light-table-filter" data-table="order-table" type="text" placeholder="Buscar...">
        <br>
        <table class="table table-hover order-table" id="tabla">
            <thead class="thead-dark">
                <tr>
                    <th style="width:180px; background-color: #5DACCD; color:#fff">Nombre</th>
                    <th style="width:180px; background-color: #5DACCD; color:#fff">Titulación</th>
                    <th style="width:180px; background-color: #5DACCD; color:#fff">Descripción</th>
                    <th style="width:180px; background-color: #5DACCD; color:#fff">Experiencia</th>
                    <th style="width:180px; background-color: #5DACCD; color:#fff">Aceptar</th>
                    <th style="width:180px; background-color: #5DACCD; color:#fff">Denegar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $Numero_dependiente = $dependiente->Numero_socio;

                $sql = "SELECT * FROM solicitudes where dependiente=:dependiente";
                $consulta = $conexion->prepare($sql);
                $consulta->execute([":dependiente" => $Numero_dependiente]);



                while ($dependiente_consulta = $consulta->fetch(PDO::FETCH_OBJ)) {

                    $sql1 = "SELECT * FROM voluntario where Numero_socio=:Numero_socio";
                    $consulta2 = $conexion->prepare($sql1);
                    $consulta2->execute([":Numero_socio" => $dependiente_consulta->voluntario]);
                    $voluntario = $consulta2->fetch(PDO::FETCH_OBJ);
                ?>

                    <tr>

                        <td><?php echo $voluntario->Nombre ?></td>
                        <td><?php echo $voluntario->Titulacion ?></td>
                        <td><?php echo $voluntario->descripcion ?></td>
                        <td><?php echo $voluntario->experiencia ?></td>
                        <td>

                            <form action="aceptar_solicitud.php" method="post">
                                <input type="hidden" name="voluntario" value="<?php echo $voluntario->Numero_socio ?>">
                                <input type="hidden" name="dependiente" value="<?php echo $dependiente->Numero_socio ?>">
                                <input type="submit" class="btn btn-primary" value="Aceptar Solicitud">
                            </form>
                        </td>

                        <td>
                            <form action="eliminar_solicitud.php" method="post">
                                <input type="hidden" name="voluntario" value="<?php echo $voluntario->Numero_socio ?>">
                                <input type="hidden" name="dependiente" value="<?php echo $dependiente->Numero_socio ?>">
                                <input type="submit" class="btn btn-danger" value="Denegar Solicitud">
                            </form>
                        </td>
                    <?php } ?>
                    </tr>
            </tbody>
        </table>
    <?php } ?>
</body>

</html>
<?php
