<?php
session_start();
if (!isset($_SESSION['administrador'])) {
    header("Location: login.php");
}
include_once "conectar.php";
include_once "cabecera.php";
$conexion = conectar();
$administrador = $_SESSION['administrador'];

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
    <script src="js/buscar.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body style="background-color: #4FD53C;">

    <?php
    administrador($administrador);
    ?>
    <br>
    <?php
    function esBoraable($id, $conexion)
    {
        $sql = "SELECT * FROM parejas WHERE id_voluntario=:id_voluntario;";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([":id_voluntario" => $id]);
        if ($consulta->rowCount() < 1) {
            return true;
        } else {
            return false;
        }
    }

    $sql = "SELECT * FROM voluntario";
    $consulta = $conexion->prepare($sql);
    $consulta->execute();


    ?>
    <input class="form-control col-md-3 light-table-filter" data-table="order-table" type="text" placeholder="buscar..">
    <br>
    <br>
    <table class="table table-hover order-table" id="tabla">
        <thead class="thead-dark">
            <tr>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Numero de Socio</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Nombre</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Correo</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Modificar</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php

            while ($voluntario = $consulta->fetch(PDO::FETCH_OBJ)) {

            ?>

                <tr>
                    <td><?php echo $voluntario->Numero_socio ?></td>
                    <td><?php echo $voluntario->Nombre ?></td>
                    <td><?php echo $voluntario->Correo ?></td>
                    <td>

                        <form action="modificar_voluntarios_admin.php" method="post">
                            <input type="hidden" id="voluntario" name="voluntario" value="<?php echo $voluntario->Numero_socio ?>">
                            <input type="submit" class="btn btn-primary" value="Modificar">
                        </form>
                    </td>

                    <td>
                        <?php
                        if (esBoraable($voluntario->Numero_socio, $conexion) == true) {
                        ?>
                            <form action="eliminar_voluntario.php" method="post">
                                <input type="hidden" id="voluntario" name="voluntario" value="<?php echo $voluntario->Numero_socio ?>">
                                <input type="submit" class="btn btn-danger" value="Eliminar">
                            </form>
                        <?php
                        } else {
                        ?>
                            <div class="alert alert-warning alert-dismissable">
                                El voluntario tiene a un dependiente a su cargo, debes deshacer la pareja
                            </div>
                        <?php
                        }
                        ?>
                    </td>
                <?php } ?>



                </tr>
        </tbody>
    </table>

</body>

</html>
<?php
